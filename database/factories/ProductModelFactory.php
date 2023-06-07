<?php

namespace Database\Factories;

use App\Models\StoreModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductModel>
 */
class ProductModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'store_id' => StoreModel::pluck('store_id')->random(),
            'name' => $this->faker->name(1, 50),
            'sku'  => $this->faker->randomNumber(8, false),
            'inventory_quantity' => $this->faker->randomNumber(4, false),
            'inventory_updated_time' => now(),
        ];
    }
}
