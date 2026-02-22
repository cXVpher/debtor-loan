<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pembayaran>
 */
class PembayaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal' =>  fake()->date(),
            'jumlah' => fake()->numberBetween(0,1000000),
            'tagihan_id' => fake()->numberBetween(0,20),
            
        ];
    }
}
