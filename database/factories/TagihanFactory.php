<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tagihan>
 */
class TagihanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'tanggal' => fake()->date(),
            'jumlah' => strval(fake()->numberBetween(0, 1000000)),
            'debitur_id' => fake()->numberBetween(1,10)
        ];
    }
}
