<?php

namespace Database\Factories;

use App\Models\Url;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UrlFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Url::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tag' => $this->faker->firstName,
            'destination' => $this->faker->unique()->url,
            'qr_code' => $this->faker->unique()->imageUrl(),
            'visits' => $this->faker->numberBetween(1, 100),
            'active' => $this->faker->numberBetween(0,1),
        ];
    }
}
