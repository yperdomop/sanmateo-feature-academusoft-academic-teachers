<?php

namespace App\Http\Utils\Data;

use Illuminate\Support\Collection;

trait FilterTrait
{
    public function filterStringCollection(Collection $collection, string $attributeName, string $attributeValue) {
        return $collection->filter(function($value, $key) use($attributeName, $attributeValue) {
            return str_contains(strtolower($value[$attributeName]), strtolower($attributeValue));
        });
    }
}
