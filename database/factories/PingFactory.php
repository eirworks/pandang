<?php

namespace Database\Factories;

use App\Models\Ping;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ping::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'monitor_id' => 1,
            'status' => '200',
            'time' => $this->faker->boolean(5) ? 0.0 : rand(100.0, 1200.0) / 1000.0,
            'response' => ['ok'],
            'request' => ['headers' => [
                'Authorization' => 'Bearer '.Str::random(32),
            ]]
        ];
    }
}
