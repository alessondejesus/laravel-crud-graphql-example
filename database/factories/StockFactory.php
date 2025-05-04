<?php

namespace Database\Factories;

use App\Enum\StockUnitTypeEnum;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    protected $model = Stock::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'amount' => fake()->numberBetween(-10000000, 10000000),
            'unit_type' => collect(StockUnitTypeEnum::cases())->random()->name,
        ];
    }
}
