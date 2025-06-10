<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id('contract_id');
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->foreignId('property_id')->constrained('propiedades', 'property_id');
            $table->foreignId('client_id')->constrained('clientes', 'client_id');
            $table->enum('contract_type', ['Alquiler', 'Venta']);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->decimal('amount', 15, 2);
            $table->enum('status', ['Activo', 'Inactivo'])->default('Activo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};