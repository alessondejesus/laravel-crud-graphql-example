<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Client;

use App\Models\Client;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class DeleteClientMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteClient',
        'description' => 'Delete a Client'
    ];

    public function type(): Type
    {
        return Type::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'ID of the Client that will be deleted',
            ],
        ];
    }

    public function resolve($root, array $args)
    {
        $client = Client::query()
            ->findOrFail($args['id']);

        return $client->delete();
    }
}
