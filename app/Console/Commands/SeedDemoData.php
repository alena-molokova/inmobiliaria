<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeedDemoData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:seed {--fresh : Очистить базу данных перед заполнением}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Заполнить базу данных демонстрационными данными';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🏠 Iniciando la creación de datos de demostración para la inmobiliaria...');

        if ($this->option('fresh')) {
            $this->info('🗑️ Limpiando base de datos...');
            Artisan::call('migrate:fresh');
            $this->info('✅ Base de datos limpiada.');
        }

        $this->info('🌱 Ejecutando seeders...');
        
        try {
            Artisan::call('db:seed');
            $this->info('✅ Datos de demostración creados exitosamente!');
            
            $this->info("\n📋 Información de acceso:");
            $this->info("   Admin: admin@gmail.com / admin123");
            $this->info("   Empleado: empleado@gmail.com / empleado123");
            $this->info("   Usuario: usuario@gmail.com / usuario123");
            $this->info("   Demo Admin: demo.admin@inmobiliaria.com / demo123");
            $this->info("   Demo Empleado: demo.empleado@inmobiliaria.com / demo123");
            $this->info("   Demo Usuario: demo.usuario@inmobiliaria.com / demo123");
            
        } catch (\Exception $e) {
            $this->error('❌ Error al crear datos de demostración: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
} 