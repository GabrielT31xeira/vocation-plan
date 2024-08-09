<?php

namespace Database\Factories;

use App\Models\Holiday;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Holiday>
 */
class HolidayFactory extends Factory
{
    protected $model = Holiday::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'description' => $this->faker->text,
            'date' => $this->faker->date,
            'location' => $this->faker->address,
            'created_by' => User::factory(),
        ];
    }
}
