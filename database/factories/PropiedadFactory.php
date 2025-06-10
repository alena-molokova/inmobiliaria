<?php

namespace Database\Factories;

use App\Models\Propiedad;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropiedadFactory extends Factory
{
    protected $model = Propiedad::class;

    public function definition()
    {
        return [
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'property_type' => $this->faker->randomElement(['Casa', 'Apartamento', 'Terreno', 'Comercial', 'Dúplex']),
            'price' => $this->faker->numberBetween(100000, 500000),
            'description' => $this->faker->sentence,
            'status' => 'Disponible',
            'employee_id' => User::whereHas('role', fn($q) => $q->where('role_name', 'Empleado'))->inRandomOrder()->first()?->user_id ?? null,
        ];
    }
}

