<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Product;

use App\Models\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class DeleteProductMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteProduct',
        'description' => 'Delete a Product'
    ];

    public function type(): Type
    {
        return Type::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'ID of the Product that will be deleted',
            ],
        ];
    }

    public function resolve($root, array $args)
    {
        $product = Product::query()
            ->findOrFail($args['id']);

        return $product->delete();
    }
}
