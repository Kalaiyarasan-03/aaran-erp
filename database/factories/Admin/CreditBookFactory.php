<?php

namespace Database\Factories\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\CreditBook>
 */
class CreditBookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'vname' => $this->faker->name(),
            'active_id' => '1',
        ];
    }
}
