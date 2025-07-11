<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'email'      => $this->faker->unique()->safeEmail,
            'phone'      => $this->faker->phoneNumber,
            'address'    => $this->faker->address,
        ];
    }

    /**
     * Создает клиента с испанскими именами
     */
    public function espanol()
    {
        return $this->state(function (array $attributes) {
            $nombres = ['Carlos', 'María', 'José', 'Ana', 'Luis', 'Carmen', 'Miguel', 'Isabel', 'Juan', 'Rosa'];
            $apellidos = ['García', 'Rodríguez', 'González', 'Fernández', 'López', 'Martínez', 'Sánchez', 'Pérez', 'Gómez', 'Martin'];
            
            return [
                'first_name' => $this->faker->randomElement($nombres),
                'last_name' => $this->faker->randomElement($apellidos),
            ];
        });
    }

    /**
     * Создает клиента с конкретным городом
     */
    public function enCiudad($ciudad)
    {
        return $this->state(function (array $attributes) use ($ciudad) {
            return [
                'address' => $this->faker->streetAddress . ', ' . $ciudad,
            ];
        });
    }
}
