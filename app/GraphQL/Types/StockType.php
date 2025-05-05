<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class StockType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Stock',
        'description' => 'Stock of a product'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the movement',
            ],
            'product_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The ID of the product'
            ],
            'amount' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Amount registered'
            ],
            'unit_type' => [
                'type' => Type::nonNull(Type::string()), // TODO: it would be StockUnitTypeEnum
                'description' => 'Unity type of amount registered'
            ],
        ];
    }
}
