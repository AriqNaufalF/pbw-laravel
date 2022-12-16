<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collection>
 */
class CollectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'namaKoleksi' => $this->faker->sentence(mt_rand(2, 3)),
            'jenisKoleksi' => mt_rand(1, 3),
            'jumlahKoleksi' => $this->faker->randomDigit()
        ];
    }
}
