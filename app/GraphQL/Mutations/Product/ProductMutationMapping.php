<?php

namespace App\GraphQL\Mutations\Product;

class ProductMutationMapping
{
    const MUTATIONS = [
        UpdateProductMutation::class,
        CreateProductMutation::class,
        DeleteProductMutation::class,
    ];
}