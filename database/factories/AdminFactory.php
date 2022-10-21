<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Kyi Sin',
            'email' => 'kssll@gmail.com',
            'phone' => '09-784114719',
            'address' => 'the place where I want to live',
            'password' => '12345678', // password
        ];
    }
}
