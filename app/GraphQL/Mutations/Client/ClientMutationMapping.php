<?php

namespace App\GraphQL\Mutations\Client;

class ClientMutationMapping
{
    const MUTATIONS = [
        CreateClientMutation::class,
        UpdateClientMutation::class,
        DeleteClientMutation::class,
    ];
}