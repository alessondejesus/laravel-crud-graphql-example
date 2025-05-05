<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Client;

use App\Models\Client;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UpdateClientMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateClient',
        'description' => 'Update a Client'
    ];

    public function type(): Type
    {
        return GraphQL::type('Client');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
            ],
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
        $client = Client::query()
            ->findOrFail($args['id']);

        unset($args['id']);
        
        $client->update($args);

        return $client;
    }
}
