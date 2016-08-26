<?php

namespace App\Http\Components;

use FitlifeGroup\Models\Eloquent\Product;
use Cache;

class Menu
{
    public static function featuredMenuItem($id)
    {
        $cache_key = 'menu_featured_item_' . $id;
        return Cache::remember($cache_key, 60, function () use ($id) {
            if ($product = Product::with('baseVariant')->find($id)) {
                return [
                    'id' => $product->id,
                    'slug' => $product->slug,
                    'name' => $product->name,
                    'description' => $product->description,
                    'image_url' => 'https://s3.amazonaws.com/SHREDZ-CARTS/products/en/' . $product->baseVariant->sku . '/primaryimage_new.png'
                ];
            }
        });
    }

}
