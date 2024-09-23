<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'stock' => $this->faker->randomNumber(2), // Genera un número aleatorio de 2 dígitos
            'image' => $this->faker->imageUrl(), // Genera una URL de imagen aleatoria
            'price' => $this->faker->randomFloat(2, 0, 1000), // Genera un precio entre 0 y 1000 con 2 decimales
            'category_id' => \App\Models\Category::factory(), // Asume que tienes una relación y crea una categoría automáticamente
        ];
    }
}
