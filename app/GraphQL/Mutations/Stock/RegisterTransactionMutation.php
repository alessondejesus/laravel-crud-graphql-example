<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Stock;

use App\Models\Stock;
use App\Models\Transaction;
use DomainException;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;
use Rebing\GraphQL\Support\Mutation;

class RegisterTransactionMutation extends Mutation
{
    protected $attributes = [
        'name' => 'registerTransaction',
        'description' => 'Register an transaction'
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
            'client_id' => [
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
        $unitType = $args['unit_type'];
        $amount = $args['amount'];
        $productId = $args['product_id'];

        $currentInventory = Stock::query()
            ->select(DB::raw('SUM(amount) as total_amount'))
            ->where('product_id', $productId)
            ->where('unit_type', $unitType)
            ->groupBy('product_id', 'unit_type')
            ->first();

        if (!$currentInventory) {
            throw new DomainException("Product $productId hasn't inventory for unit $unitType");
        }

        $currentAmount = $currentInventory->total_amount;

        if (($currentAmount - $amount) < 0) {
            throw new DomainException("Invalid amount, current amount is: $currentAmount");
        }

        $stock = Stock::query()
            ->create([
                'product_id' => $productId,
                'amount' => $amount * -1,
                'unit_type' => $unitType
            ]);

        return Transaction::query()->create([
            'stock_id' => $stock->id,
            'client_id' => $args['client_id']
        ]);
    }
}
