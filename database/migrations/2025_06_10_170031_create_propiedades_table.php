<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('propiedades', function (Blueprint $table) {
            $table->id('property_id');
            $table->string('address', 255);
            $table->string('city', 100);
            $table->enum('property_type', ['Casa', 'Apartamento', 'Terreno', 'Comercial', 'Dúplex']);
            $table->decimal('price', 15, 2);
            $table->text('description')->nullable();
            $table->enum('status', ['Disponible', 'Vendido', 'Alquilado', 'Pendiente'])->default('Disponible');
            $table->foreignId('employee_id')->nullable()->constrained('users', 'user_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('propiedades');
    }
};