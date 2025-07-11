<?php

namespace Database\Factories;

use App\Models\Contrato;
use App\Models\Cliente;
use App\Models\Propiedad;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContratoFactory extends Factory
{
    protected $model = Contrato::class;

    public function definition()
    {
        $tipos = ['Alquiler', 'Venta', 'Arrendamiento', 'Compra'];
        $estados = ['Activo', 'Pendiente', 'Finalizado', 'Cancelado', 'En Revisión'];
        
        return [
            'user_id' => User::inRandomOrder()->first()?->user_id,
            'client_id' => Cliente::inRandomOrder()->first()?->client_id,
            'property_id' => Propiedad::inRandomOrder()->first()?->property_id,
            'contract_type' => $this->faker->randomElement($tipos),
            'start_date' => now()->subDays(rand(0, 365)),
            'end_date' => now()->addDays(rand(30, 1095)), // до 3 лет
            'amount' => $this->faker->numberBetween(50000, 500000),
            'status' => $this->faker->randomElement($estados),
        ];
    }

    /**
     * Создает контракт аренды
     */
    public function alquiler()
    {
        return $this->state(function (array $attributes) {
            return [
                'contract_type' => 'Alquiler',
                'amount' => $this->faker->numberBetween(500, 3000), // арендная плата
                'start_date' => now()->subMonths(rand(1, 12)),
                'end_date' => now()->addMonths(rand(6, 24)),
            ];
        });
    }

    /**
     * Создает контракт продажи
     */
    public function venta()
    {
        return $this->state(function (array $attributes) {
            return [
                'contract_type' => 'Venta',
                'amount' => $this->faker->numberBetween(100000, 800000),
                'start_date' => now()->subDays(rand(1, 30)),
                'end_date' => now()->addDays(rand(30, 90)),
            ];
        });
    }

    /**
     * Создает активный контракт
     */
    public function activo()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'Activo',
            ];
        });
    }

    /**
     * Создает завершенный контракт
     */
    public function finalizado()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'Finalizado',
                'start_date' => now()->subMonths(rand(6, 24)),
                'end_date' => now()->subDays(rand(1, 30)),
            ];
        });
    }

    /**
     * Создает контракт с конкретным пользователем
     */
    public function conUsuario($userId)
    {
        return $this->state(function (array $attributes) use ($userId) {
            return [
                'user_id' => $userId,
            ];
        });
    }
}

