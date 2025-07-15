<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Propiedad;
use App\Models\User;

class PropiedadSeeder extends Seeder
{
    public function run(): void
    {
        $empleados = User::whereHas('role', function ($q) {
            $q->where('role_name', 'Empleado');
        })->pluck('user_id');

        if ($empleados->isEmpty()) {
            echo "❗ No se encontraron empleados. Primero completa la tabla de usuarios.\n";
            return;
        }

        Propiedad::factory()
            ->count(25)
            ->state(function () use ($empleados) {
                return [
                    'employee_id' => $empleados->random(),
                ];
            })
            ->create();

        Propiedad::factory()
            ->count(10)
            ->casa()
            ->state(function () use ($empleados) {
                return [
                    'employee_id' => $empleados->random(),
                ];
            })
            ->create();

        Propiedad::factory()
            ->count(15)
            ->apartamento()
            ->state(function () use ($empleados) {
                return [
                    'employee_id' => $empleados->random(),
                ];
            })
            ->create();

        Propiedad::factory()
            ->count(8)
            ->comercial()
            ->state(function () use ($empleados) {
                return [
                    'employee_id' => $empleados->random(),
                ];
            })
            ->create();

        $ciudades = ['Buenos Aires', 'Córdoba', 'Rosario', 'Mendoza', 'La Plata', 'Mar del Plata'];
        foreach ($ciudades as $ciudad) {
            Propiedad::factory()
                ->count(5)
                ->enCiudad($ciudad)
                ->state(function () use ($empleados) {
                    return [
                        'employee_id' => $empleados->random(),
                    ];
                })
                ->create();
        }

        Propiedad::factory()
            ->count(20)
            ->disponible()
            ->state(function () use ($empleados) {
                return [
                    'employee_id' => $empleados->random(),
                ];
            })
            ->create();

        echo "✅ Se crearon " . Propiedad::count() . " propiedades exitosamente.\n";
    }
}

