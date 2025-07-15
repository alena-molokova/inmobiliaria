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
        $tipos = ['Casa', 'Apartamento', 'Terreno', 'Comercial', 'Dúplex'];
        $estados = ['Disponible', 'Vendido', 'Alquilado', 'Pendiente'];
        $ciudades = ['Buenos Aires', 'Córdoba', 'Rosario', 'Mendoza', 'La Plata', 'San Miguel de Tucumán', 'Mar del Plata', 'Salta', 'Santa Fe', 'San Juan'];
        $calles = ['Av. Corrientes', 'Av. 9 de Julio', 'Av. Santa Fe', 'Av. Córdoba', 'Av. Belgrano', 'Av. San Martín', 'Av. Rivadavia', 'Av. Callao', 'Av. Pueyrredón', 'Av. Las Heras'];
        
        return [
            'address' => $this->faker->randomElement($calles) . ' ' . $this->faker->numberBetween(100, 9999),
            'city' => $this->faker->randomElement($ciudades),
            'property_type' => $this->faker->randomElement($tipos),
            'price' => $this->faker->numberBetween(50000, 2000000),
            'description' => $this->faker->paragraph(3),
            'status' => $this->faker->randomElement($estados),
            'employee_id' => User::whereHas('role', fn($q) => $q->where('role_name', 'Empleado'))->inRandomOrder()->first()?->user_id ?? null,
        ];
    }

    /**
     * Создает дом
     */
    public function casa()
    {
        return $this->state(function (array $attributes) {
            return [
                'property_type' => 'Casa',
                'price' => $this->faker->numberBetween(200000, 800000),
                'description' => $this->faker->paragraph(2) . ' Hermosa casa familiar con jardín y garaje.',
            ];
        });
    }

    /**
     * Создает квартиру
     */
    public function apartamento()
    {
        return $this->state(function (array $attributes) {
            return [
                'property_type' => 'Apartamento',
                'price' => $this->faker->numberBetween(80000, 400000),
                'description' => $this->faker->paragraph(2) . ' Apartamento moderno con todas las comodidades.',
            ];
        });
    }

    /**
     * Создает коммерческую недвижимость
     */
    public function comercial()
    {
        return $this->state(function (array $attributes) {
            return [
                'property_type' => 'Comercial',
                'price' => $this->faker->numberBetween(150000, 1000000),
                'description' => $this->faker->paragraph(2) . ' Local comercial en excelente ubicación.',
            ];
        });
    }

    /**
     * Создает недвижимость в конкретном городе
     */
    public function enCiudad($ciudad)
    {
        return $this->state(function (array $attributes) use ($ciudad) {
            return [
                'city' => $ciudad,
            ];
        });
    }

    /**
     * Создает доступную недвижимость
     */
    public function disponible()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'Disponible',
            ];
        });
    }
}

