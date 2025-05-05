<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ClientFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function name(string $term): self
    {
        return $this->where(function ($query) use ($term) {
            $query->whereRaw(
                "MATCH(first_name, last_name) AGAINST (? IN BOOLEAN MODE)",
                [$term]
            )->orWhere(function ($subQuery) use ($term) {
                $subQuery->whereLike('first_name', "%$term%")
                    ->orWhereLike('last_name', "%$term%");
            });
        });
    }

    public function email(string $email): self
    {
        return $this->whereLike('email', "$email");
    }
}
