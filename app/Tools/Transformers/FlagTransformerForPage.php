<?php
/**
 * Created by PhpStorm.
 * User: LaravelDude
 * Date: 12/9/15
 * Time: 4:55 PM
 */

namespace App\Tools\Transformers;


class FlagTransformerForPage extends Transformer
{
    public function transform($item)
    {
        $flags = [
            "country_code" => $item['country_code'],
            "address_country" => $item['address_country'],
            "1xfile" => env("FLAGS_BASE_URL").$item['1xfile'],
            "2xfile" => env("FLAGS_BASE_URL").$item['2xfile'],
            "text_color" => $item['text_color'],
            "text" => $item['text'],
        ];
        return $flags;
    }
}