<?php

namespace Database\Factories;

use App\Models\Monitor;
use Illuminate\Database\Eloquent\Factories\Factory;

class MonitorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Monitor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_id' => 1,
            'name' => $this->faker->colorName,
            'url' => 'https://google.com',
        ];
    }
}
