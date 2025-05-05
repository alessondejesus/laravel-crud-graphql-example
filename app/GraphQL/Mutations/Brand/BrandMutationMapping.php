<?php

namespace App\GraphQL\Mutations\Brand;

class BrandMutationMapping
{
    const MUTATIONS = [
        \App\GraphQL\Mutations\Brand\CreateBrandMutation::class,
        \App\GraphQL\Mutations\Brand\UpdateBrandMutation::class,
        \App\GraphQL\Mutations\Brand\DeleteBrandMutation::class,
    ];
}