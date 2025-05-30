<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Brand;

use App\Models\Brand;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateBrandMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateBrand',
        'description' => 'Update a Brand'
    ];

    public function type(): Type
    {
        return GraphQL::type('Brand');
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
        ];
    }

    public function resolve($root, array $args)
    {
        $brand = Brand::query()
            ->findOrFail($args['id']);

        unset($args['id']);
        
        $brand->update($args);

        return $brand;
    }
}
