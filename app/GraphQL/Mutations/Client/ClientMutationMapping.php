<?php

namespace App\GraphQL\Mutations\Client;

class ClientMutationMapping
{
    const MUTATIONS = [
        \App\GraphQL\Mutations\Client\CreateClientMutation::class,
        \App\GraphQL\Mutations\Client\UpdateClientMutation::class,
        \App\GraphQL\Mutations\Client\DeleteClientMutation::class,
    ];
}