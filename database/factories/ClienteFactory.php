<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition()
    {
        // Аргентинские имена
        $nombres = [
            'Santiago', 'Mateo', 'Benjamín', 'Lucas', 'Joaquín', 'Pedro', 'Tomás', 'Agustín', 'Francisco', 'Juan',
            'Sofía', 'Valentina', 'Isabella', 'Emma', 'Olivia', 'Camila', 'Lucía', 'Victoria', 'Martina', 'Julia'
        ];
        
        // Аргентинские фамилии
        $apellidos = [
            'González', 'Rodríguez', 'Gómez', 'Fernández', 'López', 'Díaz', 'Martínez', 'Pérez', 'García', 'Sánchez',
            'Romero', 'Sosa', 'Torres', 'Álvarez', 'Ruiz', 'Ramírez', 'Flores', 'Acosta', 'Benítez', 'Silva'
        ];

        // Аргентинские города и улицы
        $ciudades = ['Buenos Aires', 'Córdoba', 'Rosario', 'Mendoza', 'La Plata', 'San Miguel de Tucumán', 'Mar del Plata', 'Salta', 'Santa Fe', 'San Juan'];
        $calles = ['Av. Corrientes', 'Av. 9 de Julio', 'Av. Santa Fe', 'Av. Córdoba', 'Av. Belgrano', 'Av. San Martín', 'Av. Rivadavia', 'Av. Callao', 'Av. Pueyrredón', 'Av. Las Heras'];

        return [
            'first_name' => $this->faker->randomElement($nombres),
            'last_name'  => $this->faker->randomElement($apellidos),
            'email'      => $this->faker->unique()->safeEmail,
            'phone'      => $this->faker->phoneNumber,
            'address'    => $this->faker->randomElement($calles) . ' ' . $this->faker->numberBetween(100, 9999) . ', ' . $this->faker->randomElement($ciudades) . ', Argentina',
        ];
    }

    /**
     * Создает клиента с аргентинскими именами
     */
    public function argentino()
    {
        return $this->state(function (array $attributes) {
            $nombres = ['Santiago', 'Mateo', 'Benjamín', 'Lucas', 'Joaquín', 'Pedro', 'Tomás', 'Agustín', 'Francisco', 'Juan'];
            $apellidos = ['González', 'Rodríguez', 'Gómez', 'Fernández', 'López', 'Díaz', 'Martínez', 'Pérez', 'García', 'Sánchez'];
            
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
            $calles = ['Av. Corrientes', 'Av. 9 de Julio', 'Av. Santa Fe', 'Av. Córdoba', 'Av. Belgrano', 'Av. San Martín', 'Av. Rivadavia', 'Av. Callao', 'Av. Pueyrredón', 'Av. Las Heras'];
            return [
                'address' => $this->faker->randomElement($calles) . ' ' . $this->faker->numberBetween(100, 9999) . ', ' . $ciudad . ', Argentina',
            ];
        });
    }
}
