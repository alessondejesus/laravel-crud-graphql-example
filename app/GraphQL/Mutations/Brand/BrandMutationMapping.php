<?php

namespace App\GraphQL\Mutations\Brand;

class BrandMutationMapping
{
    const MUTATIONS = [
        CreateBrandMutation::class,
        UpdateBrandMutation::class,
        DeleteBrandMutation::class,
    ];
}