<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        // Аргентинские имена
        $nombres = [
            'Santiago', 'Mateo', 'Benjamín', 'Lucas', 'Joaquín', 'Pedro', 'Tomás', 'Agustín', 'Francisco', 'Juan',
            'Sofía', 'Valentina', 'Isabella', 'Emma', 'Olivia', 'Camila', 'Lucía', 'Victoria', 'Martina', 'Julia'
        ];
        
        // Аргентинские фамилии
        $apellidos = [
            'González', 'Rodríguez', 'Gómez', 'Fernández', 'López', 'Díaz', 'Martínez', 'Pérez', 'García', 'Sánchez',
            'Romero', 'Sosa', 'Torres', 'Álvarez', 'Ruiz', 'Ramírez', 'Flores', 'Acosta', 'Benítez', 'Silva'
        ];

        return [
            'first_name' => $this->faker->randomElement($nombres),
            'last_name' => $this->faker->randomElement($apellidos),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'password' => bcrypt('password'),
            'role_id' => Role::inRandomOrder()->first()?->role_id ?? 1
        ];
    }

    /**
     * Создает пользователя с ролью администратора
     */
    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => Role::where('role_name', 'Administrador')->first()?->role_id ?? 1,
            ];
        });
    }

    /**
     * Создает пользователя с ролью сотрудника
     */
    public function empleado()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => Role::where('role_name', 'Empleado')->first()?->role_id ?? 2,
            ];
        });
    }

    /**
     * Создает пользователя с ролью обычного пользователя
     */
    public function usuario()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => Role::where('role_name', 'Usuario')->first()?->role_id ?? 3,
            ];
        });
    }
}
