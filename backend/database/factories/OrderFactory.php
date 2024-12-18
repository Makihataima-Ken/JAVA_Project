<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'university'=>fake()->name(),
            'major'=>fake()->name(),
            'type'=>fake()->name(),
            'description'=>fake()->text(),
            'deadline'=>fake()->date(),
            'user_id'=>User::factory(),
            'status'=>'pending',
            'file_path'=>fake()->filePath(),
            'created_at'=>fake()->time(),
        ];
    }
}
