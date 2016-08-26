<?php
namespace App\Tools\Transformers;

abstract class Transformer
{
    /**
     * Wrap array
     *
     * @param $items
     * @return array
     */
    public function transformCollection(array $items)
    {
        return array_map([$this,'transform'], $items);
    }

    public abstract function transform($item);

}
