<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class BrandType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Brand',
        'description' => "A product's brand"
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the brand',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the brand',
            ],
        ];
    }
}
