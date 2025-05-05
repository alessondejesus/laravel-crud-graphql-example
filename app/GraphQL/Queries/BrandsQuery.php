<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use App\Models\Brand;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class BrandsQuery extends Query
{
    protected $attributes = [
        'name' => 'brands',
        'description' => 'A list of brands',
        'model' => Brand::class,
    ];

    public function type(): Type
    {
        return GraphQL::paginate('Brand');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::string(),
            ],
            'name' => [
                'type' => Type::string(),
            ],
            'brand' => [
                'type' => Type::listOf(GraphQL::type('Brand')),
            ],
            'page' => [
                'type' => Type::int(),
            ],
            'limit' => [
                'type' => Type::int(),
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();

        $brands = Brand::filter($args)
            ->select($select);

        return $brands->paginate($args['limit'], ['*'], 'page', $args['page']);
    }
}
