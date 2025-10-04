<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['Být', 'Rodinný dům', 'Ateliér', 'Garsonka']),
            'description' => fake()->realTextBetween(50, 70),
            'address' => fake()->address(),
            'rent_amount' => fake()->randomFloat(0, 10000, 25000),
            'service_charge' => fake()->randomFloat(0, 2500, 7000),
            'electricity_charge' => fake()->randomFloat(0, 1000, 3000),
            'deposit_amount' => fake()->randomFloat(0, 10000, 30000),
            'contract_finished_at' => fake()->dateTimeBetween('now', '+2 years'),
            'landlord_id' => null,
            'tenant_id' => null,
            'electricity_supplier_id' => null,
            'building_manager_id' => null,
            'user_id' => 1,
        ];
    }
}
