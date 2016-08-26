<?php

namespace App\Http\Components;

use FitlifeGroup\Models\Eloquent\Channel;
use FitlifeGroup\Models\Eloquent\Product;
use App\Tools\ChannelAttribution;
use Cache;

class Store
{
    protected $attribution;

    public function __construct(ChannelAttribution $attribution)
    {
        $this->attribution = $attribution;
    }

    public function meta($key = null)
    {
        $channel = $this->attribution->getChannel();
        $agent = $this->attribution->getAgent();

        $cache_key = 'page_c' . str_pad($channel->id, 3, '0', STR_PAD_LEFT) . '_a' . str_pad($agent->id, 3, '0', STR_PAD_LEFT) . '_meta';

        $meta = Cache::remember($cache_key, 60, function () use ($channel, $agent, $key) {
            $meta = [];

            $channel
            ->meta()
            ->get()->each(function ($datum) use (&$meta) {
                $meta[$datum->key] = $datum->pivot->value;
            });

            if ($agent && !$channel->override) {
                $agent
                ->meta()
                ->get()
                ->each(function ($datum) use (&$meta) {
                    $meta[$datum->key] = $datum->pivot->value;
                });
            }

            return $meta;
        });

        return is_null($key) ? $meta : @$meta[$key];
    }

    public function assets($relation = null)
    {
        $channel = $this->attribution->getChannel();
        $agent = $this->attribution->getAgent();

        $cache_key = 'page_c' . str_pad($channel->id, 3, '0', STR_PAD_LEFT) . '_a' . str_pad($agent->id, 3, '0', STR_PAD_LEFT) . '_assets';

        $assets = Cache::remember($cache_key, 60, function () use ($channel, $agent, $relation) {
            $assets = [];
            $channel->assets->each(function ($asset) use (&$assets) {
                $rn = $asset->relation_type;

                if (!isset($assets[$rn])) {
                    $assets[$rn] = [];
                }

                $assetData = [
                    'owner' => 'Store',
                    'name' => $asset->name,
                    'description' => $asset->description,
                    // built-in cache busting by attaching timestamp as parameter
                    'path' => $asset->path . '?ts=' . $asset->updated_at->getTimestamp(),
                    'meta_keys' => [],
                ];

                foreach ($asset->meta as $key => $value) {
                    $assetData['meta_keys'][] = '_' . $key;
                    $assetData['_' . $key] = $value;
                }

                $assets[$rn][] = $assetData;
            });

            if ($agent && !$channel->override) {
                $agent->assets->each(function ($asset) use (&$assets) {
                    $rn = $asset->relation_type;

                    if (!isset($assets[$rn])) {
                        $assets[$rn] = [];
                    }

                    $assetData = [
                        'owner' => 'Agent',
                        'name' => $asset->name,
                        'description' => $asset->description,
                        // built-in cache busting by attaching timestamp as parameter
                        'path' => $asset->path . '?ts=' . $asset->updated_at->getTimestamp(),
                        'meta_keys' => [],
                    ];

                    foreach ($asset->meta as $key => $value) {
                        $assetData['meta_keys'][] = '_' . $key;
                        $assetData['_' . $key] = $value;
                    }

                    $assets[$rn][] = $assetData;
                });
            }

            return $assets;
        });

        return is_null($relation) ? $assets : @$assets[$relation];
    }
}
