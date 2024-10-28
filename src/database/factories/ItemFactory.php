<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'seller_id' => $this->faker->numberBetween(1, 10),
            'on_sale' => true,
            'name' => $this->faker->word,
            'price' => $this->faker->numberBetween(100, 10000),
            'brand' => $this->faker->word,
            'condition_id' => $this->faker->numberBetween(1, 4),
            'description' => $this->faker->sentence(20),
            'image' => $this->faker->imageUrl(320, 240, 'fashion', true),
        ];
    }

    public function notOnSale() {
        return $this->state(function (){
            return [
                'on_sale' => false,
            ];
        });
    }
}
