<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Client;

use App\Models\Client;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateClientMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createClient',
        'description' => 'Create a Client'
    ];

    public function type(): Type
    {
        return GraphQL::type('Client');
    }

    public function args(): array
    {
        return [
            'first_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'First name of the Client'
            ],
            'last_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Last name of the Client'
            ],
            'email' => [
                'type' => Type::string(), // TODO: it would be Type::email(), object calisthenics 
                'description' => 'Optional email of the Client'
            ],
        ];
    }

    public function resolve($root, array $args)
    {
        return Client::query()
            ->create($args);
    }
}
