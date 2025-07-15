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
        $this->createRoles();

        $adminRole = Role::where('role_name', 'Administrador')->first();
        echo "🔍 Role Administrador ID: " . ($adminRole ? $adminRole->role_id : 'NO ENCONTRADO') . "\n";
        
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'password' => Hash::make('admin123'),
                'first_name' => 'Santiago',
                'last_name' => 'González',
                'phone' => '123456789',
                'role_id' => $adminRole ? $adminRole->role_id : 3,
            ]
        );

        $empleadoRole = Role::where('role_name', 'Empleado')->first();
        echo "🔍 Role Empleado ID: " . ($empleadoRole ? $empleadoRole->role_id : 'NO ENCONTRADO') . "\n";
        
        User::firstOrCreate(
            ['email' => 'empleado@gmail.com'],
            [
                'password' => Hash::make('empleado123'),
                'first_name' => 'Valentina',
                'last_name' => 'Rodríguez',
                'phone' => '987654321',
                'role_id' => $empleadoRole ? $empleadoRole->role_id : 2,
            ]
        );

        $usuarioRole = Role::where('role_name', 'Usuario')->first();
        echo "🔍 Role Usuario ID: " . ($usuarioRole ? $usuarioRole->role_id : 'NO ENCONTRADO') . "\n";
        
        User::firstOrCreate(
            ['email' => 'usuario@gmail.com'],
            [
                'password' => Hash::make('usuario123'),
                'first_name' => 'Mateo',
                'last_name' => 'Martínez',
                'phone' => '555555555',
                'role_id' => $usuarioRole ? $usuarioRole->role_id : 1,
            ]
        );

        $this->createAdditionalUsers();
    }

    private function createRoles()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\Role::query()->delete();
        \DB::statement('ALTER TABLE roles AUTO_INCREMENT = 1;');
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $roles = [
            ['role_id' => 1, 'role_name' => 'Usuario'],
            ['role_id' => 2, 'role_name' => 'Empleado'],
            ['role_id' => 3, 'role_name' => 'Administrador'],
        ];

        foreach ($roles as $role) {
            \App\Models\Role::create($role);
        }
        
        echo "✅ Roles creados: " . \App\Models\Role::count() . "\n";
    }

    private function createAdditionalUsers()
    {
        User::factory()
            ->count(5)
            ->admin()
            ->create();

        User::factory()
            ->count(10)
            ->empleado()
            ->create();

        User::factory()
            ->count(20)
            ->usuario()
            ->create();
    }
}
