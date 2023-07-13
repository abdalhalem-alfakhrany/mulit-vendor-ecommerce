<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Vendor;
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
            'name' => fake()->city(),
            'description' => fake()->paragraph(10),
            'price' => fake()->numberBetween(100, 5000),

            'image_id' => Image::inRandomOrder()->limit(1)->get(['id'])->first(),
            'vendor_id' => Vendor::inRandomOrder()->limit(1)->get(['id'])->first(),
        ];
    }
}
