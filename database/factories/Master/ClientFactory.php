<?php

namespace Database\Factories\Master;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Master\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vname' => $this->faker->name(),
            'group' => $this->faker->name(),
            'user_id' => User::factory(),
            'active_id' => '1',
        ];
    }
}
