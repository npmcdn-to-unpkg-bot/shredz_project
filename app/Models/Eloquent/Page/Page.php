<?php

namespace App\Models\Eloquent\Page;

use App\Scopes\PageSortScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Eloquent\Asset\Asset;
use App\Models\Eloquent\Asset\AssetRelationType;
use App\Models\Eloquent\Tag;
use App\Models\Eloquent\Page\PageType;
use App\Models\Eloquent\MetaData;
use FitlifeGroup\Models\Eloquent\Channel;
use FitlifeGroup\Models\Eloquent\Store;
use FitlifeGroup\Models\Eloquent\Agent;
use Carbon\Carbon;

class Page extends Model {

    const DEFAULT_CACHE_LENGTH = 60;

    protected $morphClass = 'Page';

    /**
     * The fields that are mass assignable
     */
    protected $fillable = [
        'title',
        'slug',
        'penname',
        'content',
        'publish_start',
        'publish_end'
    ];

    protected $dates = [
        'publish_start',
        'publish_end'
    ];

    protected $appends = [
        'published'
    ];

    /**
     * A page can be assigned to a user
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * A page can be of a pageType
     */
    public function pageType()
    {
        return $this->belongsTo(PageType::class);
    }

    /**
     * A page may have many tags
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'tagable')->withTimestamps();;
    }

    /**
     * A Page may have may assets
     */
    public function assets()
    {
        return $this->morphToMany(Asset::class, 'assetable')->withPivot('relation_type_name');
    }

    /**
     * A page may have many metadata
     */
    public function metadata()
    {
        return $this->morphToMany(MetaData::class, 'metadatable')->withPivot('value')->withTimestamps();
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'store_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo(PageAuthor::class, 'page_author_id', 'id');
    }

    public function getPublishedAttribute()
    {
        $start = $this->publish_start;
        $end = $this->publish_end;
        $now = Carbon::now();

        return $now->gte($start) &&  $end ? $now->lte($end) : true;
    }

    public function scopeSortedByPublished($query)
    {
        return $query->orderBy('publish_start');
    }

    public function scopePublished($query)
    {
        return $query->where(function($q) {
            $q->where(function($q) {
                $q->where('pages.publish_start', '<=', Carbon::now())
                  ->orWhereNull('pages.publish_start');
            })
            ->orWhere(function($q) {
                $q->where('pages.publish_end', '>=', Carbon::now())
                  ->orWhereNull('pages.publish_end');
            });
        });
    }

    public function scopeUnpublished($query, $withPastPublications)
    {
        return $query->where(function($q) {
            $q->where('pages.publish_start', '>', Carbon::now());

            if ($withPastPublications) {
                $q->orWhere('pages.publish_end', '<', Carbon::now());
            }
        });
    }

    public function scopeIsPublished($query)
    {
        return $query->where(function($q) {
            $q->where(function($q) {
                $q->where('pages.publish_start', '<=', Carbon::now())
                  ->orWhereNull('pages.publish_start');
            })
            ->orWhere(function($q) {
                $q->where('pages.publish_end', '>=', Carbon::now())
                  ->orWhereNull('pages.publish_end');
            });
        });
    }

    public function scopePageTypeId($query, $id)
    {
        return $query->where('pages.page_type_id', '=', $id);
    }

    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }

    public function getMeta($key)
    {
        return @$this->metadata()->where('key', $key)->first()->pivot->value ?: null;
    }

    public function isPublished()
    {
        return (!$this->publish_start || $this->publish_start <= Carbon::now())
                && (is_null($this->publish_end) || $this->publish_end >= Carbon::now());

    }

    /**
     * Determina if an asset belongs to a page
     * @return Bool
     */
    public function hasAsset($assetId)
    {
        $assetIds = [];
        foreach ($this->assets as $asset) {
            $assetIds[] = $asset->id;
        }
        return in_array($assetId, $assetIds);
    }

    /**
     * Get the relation type of page's asset
     * @param int $assetId
     * @return string
     */
    public function getAssetRelationType($assetId)
    {
        return DB::table('assetables')
            ->where('asset_id', $assetId)
            ->where('assetable_id', $this->id)
            ->where('assetable_type', 'Page')
            ->pluck('relation_type_name');
    }

    /**
     * Get the sort ordert of product's asset
     * @param int $assetId
     * @return string
     */
    public function getAssetRelationTypeId($assetId)
    {
        return DB::table('assetables')
            ->where('asset_id', $assetId)
            ->where('assetable_id', $this->id)
            ->where('assetable_type', 'Page')
            ->pluck('relation_type_id');
    }

     /**
     * The the sort_order value of an asset by looking at both current product and the asset
     * @param int $assetId
     *
     * @return int
     */
    public function getAssetSortOrder($assetId)
    {
        return DB::table('assetables')
            ->where('assetable_id', $this->id)
            ->where('asset_id', $assetId)
            ->where('assetable_type', 'Page')
            ->pluck('sort_order');
    }
}
