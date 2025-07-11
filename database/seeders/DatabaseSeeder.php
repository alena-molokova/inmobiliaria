<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        echo "🌱 Iniciando la creación de datos de prueba...\n\n";
        
        $this->call([
            UserSeeder::class,
            ClienteSeeder::class,
            PropiedadSeeder::class,
            ContratoSeeder::class,
            DemoDataSeeder::class, // Добавляем демонстрационные данные
        ]);

        echo "\n✅ Todos los seeders se ejecutaron exitosamente.\n";
        echo "📊 Resumen de datos creados:\n";
        echo "   - Usuarios: " . \App\Models\User::count() . "\n";
        echo "   - Clientes: " . \App\Models\Cliente::count() . "\n";
        echo "   - Propiedades: " . \App\Models\Propiedad::count() . "\n";
        echo "   - Contratos: " . \App\Models\Contrato::count() . "\n";
    }
}
