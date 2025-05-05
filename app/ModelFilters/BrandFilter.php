<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class BrandFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function id(string $id): self
    {
        return $this->where('id', $id);
    }
    
    public function name(string $name): self
    {
        return $this->whereLike('name', "%$name%");
    }
}
