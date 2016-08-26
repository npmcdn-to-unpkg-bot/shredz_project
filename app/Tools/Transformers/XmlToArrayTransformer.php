<?php
/**
 * Created by PhpStorm.
 * User: Goku
 * Date: 12/16/15
 * Time: 9:25 AM
 */

namespace App\Tools\Transformers;


class XmlToArrayTransformer
{
    public function transform($xml)
    {
        $xml = simplexml_load_string($xml);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        return $array;
    }
}