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
        return [
            'user_id' => User::inRandomOrder()->first()?->user_id,
            'client_id' => Cliente::inRandomOrder()->first()?->client_id,
            'property_id' => Propiedad::inRandomOrder()->first()?->property_id,
            'contract_type' => 'Alquiler',
            'start_date' => now()->subDays(rand(0, 365)),
            'end_date' => now()->addDays(rand(30, 365)),
            'amount' => $this->faker->numberBetween(100000, 300000),
            'status' => 'Activo',
        ];
    }
}

