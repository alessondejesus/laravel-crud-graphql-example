<?php

namespace App\GraphQL\Mutations\Product;

class ProductMutationMapping
{
    const MUTATIONS = [
        \App\GraphQL\Mutations\Product\UpdateProductMutation::class,
        \App\GraphQL\Mutations\Product\CreateProductMutation::class,
        \App\GraphQL\Mutations\Product\DeleteProductMutation::class,
    ];
}