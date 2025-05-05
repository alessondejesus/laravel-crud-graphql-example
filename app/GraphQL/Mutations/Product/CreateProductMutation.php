<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Product;

use App\Models\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateProductMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createProduct',
        'description' => 'Create a Product'
    ];

    public function type(): Type
    {
        return GraphQL::type('Product');
    }

    public function args(): array
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Name of the product'
            ],
            'brand_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Id of the brand of this product'
            ],
        ];
    }

    public function resolve($root, array $args)
    {
        return Product::query()
            ->create($args);
    }
}
