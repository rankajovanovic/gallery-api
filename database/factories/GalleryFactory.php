<?php

namespace Database\Factories;

use App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(3),
            'description' => $this->faker->realText(100),
            'user_id' => \App\Models\User::all()->random()->id
        ];
    }
}