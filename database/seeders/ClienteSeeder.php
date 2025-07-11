<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        // Создаем 30 обычных клиентов
        Cliente::factory()->count(30)->create();

        // Создаем 10 клиентов с испанскими именами
        Cliente::factory()
            ->count(10)
            ->espanol()
            ->create();

        // Создаем клиентов в разных городах
        $ciudades = ['Madrid', 'Barcelona', 'Valencia', 'Sevilla', 'Bilbao'];
        foreach ($ciudades as $ciudad) {
            Cliente::factory()
                ->count(5)
                ->enCiudad($ciudad)
                ->create();
        }

        echo "✅ Se crearon " . Cliente::count() . " clientes exitosamente.\n";
    }
}


