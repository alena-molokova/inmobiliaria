<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contrato;
use App\Models\Cliente;
use App\Models\Propiedad;
use App\Models\User;

class ContratoSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = User::pluck('user_id');
        $clientes = Cliente::pluck('client_id');
        $propiedades = Propiedad::pluck('property_id');

        if ($usuarios->isEmpty() || $clientes->isEmpty() || $propiedades->isEmpty()) {
            echo "❗ Para generar contratos se necesitan usuarios, clientes y propiedades.\n";
            return;
        }

        Contrato::factory()
            ->count(20)
            ->state(function () use ($usuarios, $clientes, $propiedades) {
                return [
                    'user_id' => $usuarios->random(),
                    'client_id' => $clientes->random(),
                    'property_id' => $propiedades->random(),
                ];
            })
            ->create();
    }
}
