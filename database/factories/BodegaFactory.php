<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bodega>
 */
class BodegaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->sentence(),
            'direccion' => $this->faker->sentence(),
            'descripcion' => $this->faker->sentence(),
            'image' => 'bodegas/' . $this->faker->image('public/storage/bodegas', 640, 480, null, false)
        ];
    }
}
