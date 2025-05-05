<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ClientType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Client',
        'description' => 'A Client'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the client',
            ],
            'first_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The first name of the client',
            ],
            'last_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The last name of the client',
            ],
            'email' => [
                'type' => Type::string(), // TODO: it would be Type::email(), object calisthenics
                'description' => 'The email of the client'
            ],
        ];
    }
}
