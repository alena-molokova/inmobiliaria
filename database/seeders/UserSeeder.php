<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Создаем основные роли, если их нет
        $this->createRoles();

        // Создаем администраторов
        $adminRole = Role::where('role_name', 'Administrador')->first();
        echo "🔍 Role Administrador ID: " . ($adminRole ? $adminRole->role_id : 'NO ENCONTRADO') . "\n";
        
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'password' => Hash::make('admin123'),
                'first_name' => 'Admin',
                'last_name' => 'Principal',
                'phone' => '123456789',
                'role_id' => $adminRole ? $adminRole->role_id : 3,
            ]
        );

        // Создаем сотрудника
        $empleadoRole = Role::where('role_name', 'Empleado')->first();
        echo "🔍 Role Empleado ID: " . ($empleadoRole ? $empleadoRole->role_id : 'NO ENCONTRADO') . "\n";
        
        User::firstOrCreate(
            ['email' => 'empleado@gmail.com'],
            [
                'password' => Hash::make('empleado123'),
                'first_name' => 'Empleado',
                'last_name' => 'General',
                'phone' => '987654321',
                'role_id' => $empleadoRole ? $empleadoRole->role_id : 2,
            ]
        );

        // Создаем обычного пользователя
        $usuarioRole = Role::where('role_name', 'Usuario')->first();
        echo "🔍 Role Usuario ID: " . ($usuarioRole ? $usuarioRole->role_id : 'NO ENCONTRADO') . "\n";
        
        User::firstOrCreate(
            ['email' => 'usuario@gmail.com'],
            [
                'password' => Hash::make('usuario123'),
                'first_name' => 'Usuario',
                'last_name' => 'Regular',
                'phone' => '555555555',
                'role_id' => $usuarioRole ? $usuarioRole->role_id : 1,
            ]
        );

        // Создаем дополнительные пользователи с помощью фабрик
        $this->createAdditionalUsers();
    }

    private function createRoles()
    {
        // Limpiar roles existentes para evitar conflictos
        Role::truncate();
        
        $roles = [
            ['role_name' => 'Usuario'],
            ['role_name' => 'Empleado'],
            ['role_name' => 'Administrador'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
        
        echo "✅ Roles creados: " . Role::count() . "\n";
    }

    private function createAdditionalUsers()
    {
        // Создаем 5 дополнительных администраторов
        User::factory()
            ->count(5)
            ->admin()
            ->create();

        // Создаем 10 сотрудников
        User::factory()
            ->count(10)
            ->empleado()
            ->create();

        // Создаем 20 обычных пользователей
        User::factory()
            ->count(20)
            ->usuario()
            ->create();
    }
}
