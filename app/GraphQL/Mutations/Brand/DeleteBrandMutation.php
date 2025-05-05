<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Brand;

use App\Models\Brand;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class DeleteBrandMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteBrand',
        'description' => 'Delete a Brand'
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
                'description' => 'ID of the Brand that will be deleted',
            ],
        ];
    }

    public function resolve($root, array $args)
    {
        $brand = Brand::query()
            ->findOrFail($args['id']);

        return $brand->delete();
    }
}
