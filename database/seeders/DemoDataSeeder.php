<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Propiedad;
use App\Models\Contrato;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->createDemoUsers();
        $this->createDemoClients();
        $this->createDemoProperties();
        $this->createDemoContracts();
        
        echo "✅ Datos de demostración creados exitosamente.\n";
    }

    private function createDemoUsers()
    {
        // Создаем демонстрационных пользователей
        $demoUsers = [
            [
                'email' => 'demo.admin@inmobiliaria.com',
                'password' => 'demo123',
                'first_name' => 'Santiago',
                'last_name' => 'González',
                'phone' => '600123456',
                'role' => 'Administrador'
            ],
            [
                'email' => 'demo.empleado@inmobiliaria.com',
                'password' => 'demo123',
                'first_name' => 'Valentina',
                'last_name' => 'Rodríguez',
                'phone' => '600654321',
                'role' => 'Empleado'
            ],
            [
                'email' => 'demo.usuario@inmobiliaria.com',
                'password' => 'demo123',
                'first_name' => 'Mateo',
                'last_name' => 'Martínez',
                'phone' => '600987654',
                'role' => 'Usuario'
            ]
        ];

        foreach ($demoUsers as $userData) {
            $role = Role::where('role_name', $userData['role'])->first();
            $roleId = match ($userData['role']) {
                'Usuario' => 1,
                'Empleado' => 2,
                'Administrador' => 3,
                default => 1
            };
            User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'password' => Hash::make($userData['password']),
                    'first_name' => $userData['first_name'],
                    'last_name' => $userData['last_name'],
                    'phone' => $userData['phone'],
                    'role_id' => $role ? $role->role_id : $roleId
                ]
            );
        }
    }

    private function createDemoClients()
    {
        // Создаем демонстрационных клиентов
        $demoClients = [
            [
                'first_name' => 'Sofía',
                'last_name' => 'Fernández',
                'email' => 'sofia.fernandez@email.com',
                'phone' => '600111222',
                'address' => 'Av. Corrientes 1234, Buenos Aires, Argentina'
            ],
            [
                'first_name' => 'Benjamín',
                'last_name' => 'Gómez',
                'email' => 'benjamin.gomez@email.com',
                'phone' => '600333444',
                'address' => 'Av. 9 de Julio 567, Córdoba, Argentina'
            ],
            [
                'first_name' => 'Camila',
                'last_name' => 'López',
                'email' => 'camila.lopez@email.com',
                'phone' => '600555666',
                'address' => 'Av. Santa Fe 890, Rosario, Argentina'
            ]
        ];

        foreach ($demoClients as $clientData) {
            Cliente::firstOrCreate(
                ['email' => $clientData['email']],
                $clientData
            );
        }
    }

    private function createDemoProperties()
    {
        $empleados = User::whereHas('role', function ($q) {
            $q->where('role_name', 'Empleado');
        })->pluck('user_id');

        if ($empleados->isEmpty()) {
            echo "❗ No hay empleados para asignar propiedades.\n";
            return;
        }

        // Создаем демонстрационные объекты недвижимости
        $demoProperties = [
            [
                'address' => 'Av. Corrientes 1234',
                'city' => 'Buenos Aires',
                'property_type' => 'Apartamento',
                'price' => 250000,
                'description' => 'Hermoso apartamento en el centro de Buenos Aires, 2 habitaciones, 1 baño, cocina equipada.',
                'status' => 'Disponible',
                'employee_id' => $empleados->random()
            ],
            [
                'address' => 'Av. 9 de Julio 567',
                'city' => 'Córdoba',
                'property_type' => 'Casa',
                'price' => 450000,
                'description' => 'Casa familiar con jardín, 3 habitaciones, 2 baños, garaje incluido.',
                'status' => 'Disponible',
                'employee_id' => $empleados->random()
            ],
            [
                'address' => 'Av. Santa Fe 890',
                'city' => 'Rosario',
                'property_type' => 'Comercial',
                'price' => 180000,
                'description' => 'Local comercial en excelente ubicación, ideal para negocio.',
                'status' => 'Pendiente',
                'employee_id' => $empleados->random()
            ]
        ];

        foreach ($demoProperties as $propertyData) {
            Propiedad::firstOrCreate(
                [
                    'address' => $propertyData['address'],
                    'city' => $propertyData['city']
                ],
                $propertyData
            );
        }
    }

    private function createDemoContracts()
    {
        $usuarios = User::pluck('user_id');
        $clientes = Cliente::pluck('client_id');
        $propiedades = Propiedad::pluck('property_id');

        if ($usuarios->isEmpty() || $clientes->isEmpty() || $propiedades->isEmpty()) {
            echo "❗ No hay suficientes datos para crear contratos de demostración.\n";
            return;
        }

        // Создаем демонстрационные контракты
        $demoContracts = [
            [
                'user_id' => $usuarios->random(),
                'client_id' => $clientes->random(),
                'property_id' => $propiedades->random(),
                'contract_type' => 'Alquiler',
                'start_date' => now()->subMonths(2),
                'end_date' => now()->addMonths(10),
                'amount' => 1200,
                'status' => 'Activo'
            ],
            [
                'user_id' => $usuarios->random(),
                'client_id' => $clientes->random(),
                'property_id' => $propiedades->random(),
                'contract_type' => 'Venta',
                'start_date' => now()->subDays(15),
                'end_date' => now()->addDays(45),
                'amount' => 280000,
                'status' => 'Inactivo'
            ]
        ];

        foreach ($demoContracts as $contractData) {
            Contrato::create($contractData);
        }
    }
} 