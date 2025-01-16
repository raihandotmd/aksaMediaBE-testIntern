<?php

namespace Database\Factories;

use App\Models\DivisionModel;
use App\Models\EmployeeModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmployeeModelFactory extends Factory
{
    protected $model = EmployeeModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => $this->faker->imageUrl(),
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'division_id' => DivisionModel::inRandomOrder()->first()->id,
            'position' => $this->faker->jobTitle(),
        ];
    }
}
