<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Brand;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class DeleteBrandMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteBrand',
        'description' => 'A mutation'
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
        $product = Brand::query()
            ->findOrFail($args['id']);

        return $product->delete();
    }
}
