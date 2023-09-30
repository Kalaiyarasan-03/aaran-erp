<?php

namespace Database\Factories\Erp;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Erp\IroningItem>
 */
class IroningItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'vname' => $this->faker->name(),
            'active_id' => '1',
        ];
    }
}
