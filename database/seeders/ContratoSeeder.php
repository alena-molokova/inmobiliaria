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

        // Создаем 30 обычных контрактов
        Contrato::factory()
            ->count(30)
            ->state(function () use ($usuarios, $clientes, $propiedades) {
                return [
                    'user_id' => $usuarios->random(),
                    'client_id' => $clientes->random(),
                    'property_id' => $propiedades->random(),
                ];
            })
            ->create();

        // Создаем 15 контрактов аренды
        Contrato::factory()
            ->count(15)
            ->alquiler()
            ->state(function () use ($usuarios, $clientes, $propiedades) {
                return [
                    'user_id' => $usuarios->random(),
                    'client_id' => $clientes->random(),
                    'property_id' => $propiedades->random(),
                ];
            })
            ->create();

        // Создаем 10 контрактов продажи
        Contrato::factory()
            ->count(10)
            ->venta()
            ->state(function () use ($usuarios, $clientes, $propiedades) {
                return [
                    'user_id' => $usuarios->random(),
                    'client_id' => $clientes->random(),
                    'property_id' => $propiedades->random(),
                ];
            })
            ->create();

        // Создаем 20 активных контрактов
        Contrato::factory()
            ->count(20)
            ->activo()
            ->state(function () use ($usuarios, $clientes, $propiedades) {
                return [
                    'user_id' => $usuarios->random(),
                    'client_id' => $clientes->random(),
                    'property_id' => $propiedades->random(),
                ];
            })
            ->create();

        // Создаем 10 завершенных контрактов
        Contrato::factory()
            ->count(10)
            ->finalizado()
            ->state(function () use ($usuarios, $clientes, $propiedades) {
                return [
                    'user_id' => $usuarios->random(),
                    'client_id' => $clientes->random(),
                    'property_id' => $propiedades->random(),
                ];
            })
            ->create();

        // Создаем контракты для каждого сотрудника
        $empleados = User::whereHas('role', function ($q) {
            $q->where('role_name', 'Empleado');
        })->pluck('user_id');

        foreach ($empleados as $empleadoId) {
            Contrato::factory()
                ->count(3)
                ->conUsuario($empleadoId)
                ->state(function () use ($clientes, $propiedades) {
                    return [
                        'client_id' => $clientes->random(),
                        'property_id' => $propiedades->random(),
                    ];
                })
                ->create();
        }

        echo "✅ Se crearon " . Contrato::count() . " contratos exitosamente.\n";
    }
}
