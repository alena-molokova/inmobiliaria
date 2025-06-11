<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'password' => Hash::make('admin123'),
                'first_name' => 'Admin',
                'last_name' => 'Principal',
                'phone' => '123456789',
                'role_id' => 1, // Rol: Administrador
            ]
        );

        User::firstOrCreate(
            ['email' => 'empleado@gmail.com'],
            [
                'password' => Hash::make('empleado123'),
                'first_name' => 'Empleado',
                'last_name' => 'General',
                'phone' => '987654321',
                'role_id' => 2, // Rol: Empleado
            ]
        );

        User::firstOrCreate(
            ['email' => 'usuario@gmail.com'],
            [
                'password' => Hash::make('usuario123'),
                'first_name' => 'Usuario',
                'last_name' => 'Regular',
                'phone' => '555555555',
                'role_id' => 3, // Rol: Usuario
            ]
        );
    }
}
