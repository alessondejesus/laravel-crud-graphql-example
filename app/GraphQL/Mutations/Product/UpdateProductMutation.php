<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Product;

use App\Models\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateProductMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateProduct',
        'description' => 'Update a Product'
    ];

    public function type(): Type
    {
        return GraphQL::type('Product');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'brand_id' => [
                'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, array $args)
    {
        $product = Product::query()
            ->findOrFail($args['id']);
            
        unset($args['id']);
            
        $product->update($args);
        
        return $product;
    }
}
