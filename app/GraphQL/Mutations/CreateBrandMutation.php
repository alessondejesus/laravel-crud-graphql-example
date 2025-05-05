<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Brand;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateBrandMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createBrand',
        'description' => 'Create a Brand'
    ];

    public function type(): Type
    {
        return GraphQL::type('Brand');
    }

    public function args(): array
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Name of the Brand'
            ],
        ];
    }

    public function resolve($root, array $args)
    {
        return Brand::query()
            ->create([
                'name' => $args['name'],
            ]);
    }
}
