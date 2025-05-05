<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Stock;

use App\Models\Stock;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class RegisterStockMovementMutation extends Mutation
{
    protected $attributes = [
        'name' => 'registerStockMovement',
        'description' => 'Register a stock movement'
    ];

    public function type(): Type
    {
        return Type::boolean();
    }

    public function args(): array
    {
        return [
            'product_id' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'amount' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'unit_type' => [
                'type' => Type::nonNull(Type::string()), // TODO: it would be StockUnitTypeEnum
            ],
        ];
    }

    public function resolve($root, array $args)
    {
        return Stock::query()
            ->create($args);
    }
}
