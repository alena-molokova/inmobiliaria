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
            ->count(20)
            ->state(function () use ($empleados) {
                return [
                    'employee_id' => $empleados->random(),
                ];
            })
            ->create();
    }
}

