<?php

namespace App\GraphQL\Mutations\Stock;

class StockMutationMapping
{
    const MUTATIONS = [
        RegisterStockMovementMutation::class,
        RegisterTransactionMutation::class,
    ];
}