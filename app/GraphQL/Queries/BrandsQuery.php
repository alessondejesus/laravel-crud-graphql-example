<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Brand;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

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

        $brands = Brand::query()
            ->select($select);

        if (isset($args['id'])) {
            $brands->where('id', $args['id']);
        }

        if (isset($args['name'])) {
            $brands->whereLike('name', "%{$args['name']}%");
        }

        return $brands->paginate($args['limit'], ['*'], 'page', $args['page']);
    }
}
