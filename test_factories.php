<?php

/**
 * Test Script para Factories y Seeders
 * 
 * Este script demuestra cómo usar las factories para crear datos de prueba
 * sin ejecutar los seeders completos.
 */

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Cliente;
use App\Models\Propiedad;
use App\Models\Contrato;
use App\Models\Role;

echo "🏠 Test de Factories - Sistema de Inmobiliaria\n";
echo "==============================================\n\n";

try {
    // Verificar que existan roles
    $roles = Role::all();
    if ($roles->isEmpty()) {
        echo "❌ No se encontraron roles. Ejecuta las migraciones primero.\n";
        exit(1);
    }
    
    echo "✅ Roles encontrados: " . $roles->count() . "\n";
    
    // Test UserFactory
    echo "\n👥 Probando UserFactory...\n";
    $user = User::factory()->create();
    echo "   - Usuario creado: {$user->first_name} {$user->last_name} ({$user->email})\n";
    
    $admin = User::factory()->admin()->create();
    echo "   - Admin creado: {$admin->first_name} {$admin->last_name}\n";
    
    $empleado = User::factory()->empleado()->create();
    echo "   - Empleado creado: {$empleado->first_name} {$empleado->last_name}\n";
    
    // Test ClienteFactory
    echo "\n👤 Probando ClienteFactory...\n";
    $cliente = Cliente::factory()->create();
    echo "   - Cliente creado: {$cliente->first_name} {$cliente->last_name}\n";
    
    $clienteEspanol = Cliente::factory()->espanol()->create();
    echo "   - Cliente español creado: {$clienteEspanol->first_name} {$clienteEspanol->last_name}\n";
    
    $clienteMadrid = Cliente::factory()->enCiudad('Madrid')->create();
    echo "   - Cliente en Madrid: {$clienteMadrid->address}\n";
    
    // Test PropiedadFactory
    echo "\n🏘️ Probando PropiedadFactory...\n";
    $propiedad = Propiedad::factory()->create();
    echo "   - Propiedad creada: {$propiedad->property_type} en {$propiedad->city}\n";
    
    $casa = Propiedad::factory()->casa()->create();
    echo "   - Casa creada: €" . number_format($casa->price, 0, ',', '.') . "\n";
    
    $apartamento = Propiedad::factory()->apartamento()->create();
    echo "   - Apartamento creado: €" . number_format($apartamento->price, 0, ',', '.') . "\n";
    
    $comercial = Propiedad::factory()->comercial()->create();
    echo "   - Local comercial creado: €" . number_format($comercial->price, 0, ',', '.') . "\n";
    
    // Test ContratoFactory
    echo "\n📄 Probando ContratoFactory...\n";
    $contrato = Contrato::factory()->create();
    echo "   - Contrato creado: {$contrato->contract_type} - €" . number_format($contrato->amount, 0, ',', '.') . "\n";
    
    $alquiler = Contrato::factory()->alquiler()->create();
    echo "   - Alquiler creado: €" . number_format($alquiler->amount, 0, ',', '.') . "/mes\n";
    
    $venta = Contrato::factory()->venta()->create();
    echo "   - Venta creada: €" . number_format($venta->amount, 0, ',', '.') . "\n";
    
    // Estadísticas finales
    echo "\n📊 Estadísticas de datos creados:\n";
    echo "   - Usuarios: " . User::count() . "\n";
    echo "   - Clientes: " . Cliente::count() . "\n";
    echo "   - Propiedades: " . Propiedad::count() . "\n";
    echo "   - Contratos: " . Contrato::count() . "\n";
    
    echo "\n✅ Test completado exitosamente!\n";
    echo "💡 Para limpiar los datos de prueba, ejecuta: php artisan migrate:fresh\n";
    
} catch (Exception $e) {
    echo "❌ Error durante el test: " . $e->getMessage() . "\n";
    echo "📋 Stack trace:\n" . $e->getTraceAsString() . "\n";
} 