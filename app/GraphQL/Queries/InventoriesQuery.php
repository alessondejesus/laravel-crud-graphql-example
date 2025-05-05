<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Stock;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;
use Rebing\GraphQL\Support\Query;

class InventoriesQuery extends Query
{
    protected $attributes = [
        'name' => 'inventories',
        'description' => 'A list of product inventories',
    ];

    public function type(): Type
    {
        return Type::listOf(Type::string());
    }

    public function args(): array
    {
        return [
            'product_id' => [
                'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, array $args)
    {
        return Stock::query()
            ->select('product_id', 'unit_type', DB::raw('SUM(amount) as total_amount'))
            ->groupBy('product_id', 'unit_type')
            ->get();
    }
}
