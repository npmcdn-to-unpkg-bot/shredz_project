<?php

namespace App\Http\Components;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use FitlifeGroup\Models\Eloquent\Page as PageModel;
use FitlifeGroup\Models\Eloquent\PageType;
use FitlifeGroup\Models\Eloquent\Channel;
use FitlifeGroup\Models\Eloquent\Product;
use App\Tools\ChannelAttribution;
use Cache;
use App;

class Page {

    /**
     * Dependency injected App\Tools\ChannelAttribution
     *
     * @var $attribution
     */
    protected $attribution;

    /**
     * Dependency injected Illuminate\Http\Request
     *
     * @var $request
     */
    protected $request;

    /**
     * Scope value
     *
     * @var $excludingPrivate
     */
    protected $excludingPrivate = false;

    /**
     * Scope value
     *
     * @var $attachRelated
     */
    protected $attachRelated = false;

    /**
     * Transform page into a standard format
     * @param  FitlifeGroup\Models\Eloquent\Page    $page
     * @return FitlifeGroup\Models\Eloquent\Page
     */
    protected static function transformPage(PageModel $page)
    {
        if ($page->meta) {
            // Compact meta information by appending it to the body using
            // underscore '_' and it's key name
            // Then publish the keys collection as 'meta_keys'
            $meta_keys = [];
            $page->meta->each(function ($md) use ($page, &$meta_keys) {
                $metaKey = '_' . $md->key;
                $meta_keys[] = $metaKey;
                $page[$metaKey] = $md->pivot->value;
            });
            $page['meta_keys'] = $meta_keys;
        }

        if ($page->tags) {
            // Compact tags by floating them up to the main object as
            // An array of key => humanized value
            $tags = [];
            $page->tags->each(function ($tag) use (&$tags) {
                $tags[$tag->key] = $tag->name;
            });
            unset($page->tags); // unset to overwrite output
            $page['tags'] = $tags;
        }

        if ($page->assets) {
            // Compact assets by grouping them by their relation types
            $assets = [];
            $page->assets->each(function ($asset) use (&$assets) {
                $rn = $asset->pivot->relation_type_name;

                if (!isset($assets[$rn])) {
                    $assets[$rn] = [];
                }

                $assets[$rn][] = [
                    'name' => $asset->name,
                    'description' => $asset->description,
                    // built-in cache busting by attaching timestamp as parameter
                    'path' => $asset->path . '?ts=' . $asset->updated_at->getTimestamp()
                ];
            });
            unset($page->assets); // unset to overwrite output
            $page['assets'] = $assets;
        }

        if (!$page->type) {
            $page->load('type');
        }

        $type = $page->type->key;
        $page['name'] = $page->type->name;
        $page['prefix'] = $page->type->prefix;
        $page['template'] = $page->type->view;
        unset($page->type);
        $page['type'] = $type;

        $page->author->setVisible(['name', 'email']);

        // Define what attributes to show
        $page
        ->setVisible(array_merge([
            'id',
            'author',
            'type',
            'name',
            'template',
            'title',
            'content',
            'penname',
            'tags',
            'assets',
            'slug',
            'meta_keys',
            'publish_start',
            'publish_end',
            'updated_at',
            'related',
            'relatability',
        ], $meta_keys));

        return $page;
    }

    /**
     * Fetch the associated page data for the specific slug (route)
     * Attempt to find a match for agent|store, store, then any store
     * and return the first result.
     *
     * @param  string   $path
     * @return array    Normalized page data
     */
    protected function fetchPage($path, $cached = true)
    {
        // Remove starting and trailing slashes from route
        $path = preg_replace('/^\\/?(.*)\\/?$/', '$1', $path);

        $storeId = $this->attribution->getChannelId();
        $agentId = $this->attribution->getAgentId();

        $cache_key = 'page_c' . str_pad($storeId, 3, '0', STR_PAD_LEFT) . '_a' . str_pad($agentId, 3, '0', STR_PAD_LEFT) . '_' . $path;

        if (empty($page = $cached ? Cache::get($cache_key) : null)) {
            $pageTypes = PageType::prefixes($path)->get();

            try {
                $page
                =PageModel::published()
                ->with('channel', 'agent', 'type', 'tags', 'assets', 'meta', 'author')
                ->where(function ($query) use (&$storeId, &$agentId) {
                    $query
                    ->where(function ($query) use (&$storeId, &$agentId) {
                        $query
                        ->where('store_id', $storeId)
                        ->where('agent_id', $agentId);
                    })
                    ->orWhere(function ($query) use (&$storeId, &$agentId) {
                        $query
                        ->where('store_id', 0)
                        ->where('agent_id', 0);
                    });
                })
                ->where(function ($query) use ($pageTypes, $path) {
                    $pageTypes->each(function ($type) use ($query, $path) {
                        $path = str_replace($type->prefix . '/', '', $path);
                        $query->orWhere(function ($query) use ($type, $path) {
                            $query
                            ->where('slug', $path)
                            ->whereHas('type', function ($query) use ($type) {
                                $query->where('id', $type->id);
                            });
                        });
                    });
                    $query->orWhere(function ($query) use ($path) {
                        $query
                        ->where('slug', $path)
                        ->whereHas('type', function ($query) {
                            $query
                            ->where('prefix', '=', '')
                            ->orWhereNull('prefix');
                        });
                    });
                })
                ->where('private', $this->excludingPrivate ? '=' : '>=', 0)
                ->orderBy('store_id', 'desc')
                ->orderBy('id', 'desc')
                ->firstOrFail();

                static::transformPage($page);

                // return an associative array
                // use json_encode and json_decode to guarantee serializability
                $page = json_decode(json_encode($page), true);

                if ($this->attachRelated) {
                    $page['related'] = $this->fetchRelatedPages($page);
                }

            } catch (ModelNotFoundException $e) {
                $page = null;
            }

            Cache::put($cache_key, $page, 60);
        }

        $this->excludingPrivate = false;
        $this->attachRelated = false;

        return $page;
    }

    /**
     * Fetch the related pages for a given page
     * Page relations are determined by the number of similar tags
     * between the source page and the others. Pages are also filtered
     * to only find relatedness within thos of the same page type.
     *
     * @param  object|array     $page           Source page
     * @param  boolean          [$cached=true]
     * @return array                            Related pages
     */
    protected function fetchRelatedPages($page, $cached = true)
    {
        $related = [];

        if (!is_null($page) && @$page['id'] && @$page['type']) {

            $storeId = $this->attribution->getChannelId();
            $agentId = $this->attribution->getAgentId();

            $cache_key = 'related_c' . str_pad($storeId, 3, '0', STR_PAD_LEFT) . '_a' . str_pad($agentId, 3, '0', STR_PAD_LEFT) . '_page_' . $page['id'];

            if (empty($related = $cached ? Cache::get($cache_key) : [])) {

                PageModel::select(['pages.*', \DB::raw('count(*) as relatability')])
                ->with('channel', 'agent', 'type', 'tags', 'assets', 'meta', 'author')
                ->leftJoin('tagables', function($join) {
                    $join
                    ->on('tagables.tagable_id', '=', 'pages.id')
                    ->where('tagables.tagable_type', '=', \DB::raw('Page'));
                })
                ->leftJoin('tags', 'tags.id', '=', 'tagables.tag_id')
                ->where(function ($query) use (&$storeId, &$agentId) {
                    $query
                    ->where(function ($query) use (&$storeId, &$agentId) {
                        $query
                        ->where('store_id', $storeId)
                        ->where('agent_id', $agentId);
                    })
                    ->orWhere(function ($query) use (&$storeId, &$agentId) {
                        $query
                        ->where('store_id', 0)
                        ->where('agent_id', 0);
                    });
                })
                ->whereHas('type', function ($query) use ($page) {
                    $query->where('key', $page['type']);
                })
                ->where('pages.id', '<>', $page['id'])
                ->where('private', $this->excludingPrivate ? '=' : '>=', 0)
                ->whereIn('tags.key', array_keys($page['tags']))
                ->published()
                ->groupBy('pages.id')
                ->orderBy('relatability', 'desc')
                ->orderBy('publish_start', 'desc')
                ->get()
                ->each(function ($page) use (&$related) {
                    $related[] = static::transformPage($page);
                });

                $related = json_decode(json_encode($related), true);

                Cache::put($cache_key, $related, 60);
            }
        }

        return $related;
    }

    /**
     * Class constructor
     * @dependency  Illuminate\Http\Request
     * @dependency  App\Services\ChannelAttribution
     */
    public function __construct(Request $request, ChannelAttribution $attribution)
    {
        $this->request = $request;
        $this->attribution = $attribution;
    }

    /**
     * Utility function to limit the string length
     * @param  string           $str            Input string
     * @param  integer          [$limit=125]    Maximum length to return
     * @param  boolean          [$trimToLastWord=true] Make sure not to cut off a word
     * @return string
     */
    public static function limitString($str, $limit = 125, $trimToLastWord = true)
    {
        if (!empty($str)) {
            $str = trim($str);
            if ($limit > strlen($str)) {
                return $str;
            } elseif ($trimToLastWord && ($pos = strpos($str, ' ', $limit)) !== false) {
                $limit = $pos;
            }
            return substr($str, 0, $limit);
        } else {
            return '';
        }
    }

    /**
     * Utility to format a page published date into another format
     * @param  string           $dateStr
     * @param  string           [$format='M d, Y']
     * @return string
     */
    public static function formatDate($dateStr, $format = 'M d, Y')
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dateStr)->format($format);
    }

    /**
     * Chainable scope to indicate the exclusion of private pages
     * @param  bolean           [$yes=true]
     * @return $this
     */
    public function excludingPrivate($yes = true)
    {
        $this->excludingPrivate = $yes;

        return $this;
    }

    /**
     * Chainable scope to indicate the attachment of related pages
     * the output page
     * @param  boolean          [$yes=true]
     * @return $this
     */
    public function attachRelated($yes = true)
    {
        $this->attachRelated = $yes;

        return $this;
    }

    /**
     * Get the page associated to the current store/agent and path
     * @param  boolean          [$cached=true]
     * @return array
     */
    public function current($cached = true)
    {
        return $this->fetchPage($this->request->path(), $cached);
    }

    /**
     * Get the page associated to the current store/agent and supplied path
     * @param  string           $path
     * @param  boolean          [$cached=true]
     * @return array
     */
    public function path($path, $cached = true)
    {
        return $this->fetchPage($path, $cached);
    }

    /**
     * Published method for getting the related pages to a particular page
     * @param  array            $page
     * @param  boolean          [$cached=true]
     * @return array
     */
    public function relatedPagesTo($page, $cached = true)
    {
        return $this->fetchRelatedPages($page, $cached);
    }

    /**
     * Published method for transforming/normalizing a raw Page model
     * @param  FitlifeGroup\Models\Eloquent\Page    $input
     * @return array
     */
    public static function transform($input)
    {
        if ($input instanceof Collection) {
            $input->each(function ($page) {
                static::transformPage($page);
            });
        } elseif ($input instanceof PageModel) {
            static::transformPage($input);
        }

        return $input;
    }

    /**
     * Retrieve blog pages ordered by their publication date
     * @param  String       $category
     * @param  boolean      $cached
     * @return array
     */
    public function blogs($category = null, $cached = true) {
        $storeId = $this->attribution->getChannelId();
        $agentId = $this->attribution->getAgentId();

        $cache_key = 'blogs_' . str_pad($storeId, 3, '0', STR_PAD_LEFT) . '_a' . str_pad($agentId, 3, '0', STR_PAD_LEFT) . (empty($category) ? '' : '_' . $category);

        if (empty($blogs = $cached ? Cache::get($cache_key) : null)) {
            $blogs
            =PageModel::published()
            ->excludingPrivate()
            ->with('channel', 'agent', 'type', 'tags', 'assets', 'meta', 'author')
            ->whereHas('tags', function ($query) use ($category) {
                if (!empty($category)) {
                    $query->where('key', $category);
                } else {
                    $query->whereNotNull('key');
                }
            })
            ->sortedByStickyDate()
            ->recentPublicationsFirst()
            ->ofType(8)
            ->get()
            ->each(function ($page) {
                static::transform($page);
            });

            $blogs = json_decode(json_encode($blogs), true);

            Cache::put($cache_key, $blogs, 60);
        }

        return $blogs;
    }

}