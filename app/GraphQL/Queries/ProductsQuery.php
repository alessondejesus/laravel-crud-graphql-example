<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Product;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class ProductsQuery extends Query
{
    protected $attributes = [
        'name' => 'products',
        'description' => 'A list of products',
        'model' => Product::class,
    ];

    public function type(): Type
    {
        return GraphQL::paginate('Product');
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
            'brand_id' => [
                'type' => Type::string(),
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
        $with = $fields->getRelations();
        
        $products = Product::query()
            ->select($select)
            ->with($with);

        if (isset($args['id'])) {
            $products->where('id', $args['id']);
        }

        if (isset($args['name'])) {
            $products->whereLike('name', "%{$args['name']}%");
        }

        if (isset($args['brand_id'])) {
            $products->where('brand_id', $args['brand_id']);
        }

        return $products->paginate($args['limit'], ['*'], 'page', $args['page']);
    }
}
