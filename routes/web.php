<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    return view('auth.login');
})->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    /**
     * Rutas para Administradores
     */
    Route::middleware(['role:administrador'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('usuarios');
        Route::get('/empleados', [AdminController::class, 'empleados'])->name('empleados');
        Route::get('/reportes', [AdminController::class, 'reportes'])->name('reportes');
        Route::get('/propiedades', [AdminController::class, 'propiedades'])->name('propiedades');
        Route::get('/clientes', [AdminController::class, 'clientes'])->name('clientes');
        Route::get('/contratos', [AdminController::class, 'contratos'])->name('contratos');
    });

    /**
     * Rutas para Empleados
     */
    Route::middleware(['role:empleado,administrador'])->prefix('empleado')->name('empleado.')->group(function () {
        Route::get('/dashboard', [EmpleadoController::class, 'dashboard'])->name('dashboard');

        Route::get('/propiedades', [EmpleadoController::class, 'propiedades'])->name('propiedades');
        Route::post('/propiedades', [EmpleadoController::class, 'storePropiedad'])->name('propiedades.store');
        Route::get('/propiedades/{id}/edit', [EmpleadoController::class, 'editPropiedad'])->name('propiedades.edit');
        Route::put('/propiedades/{id}', [EmpleadoController::class, 'updatePropiedad'])->name('propiedades.update');
        Route::delete('/propiedades/{id}', [EmpleadoController::class, 'destroyPropiedad'])->name('propiedades.destroy');

        Route::get('/clientes', [EmpleadoController::class, 'clientes'])->name('clientes');
        Route::post('/clientes', [EmpleadoController::class, 'storeCliente'])->name('clientes.store');
        Route::get('/clientes/{id}/edit', [EmpleadoController::class, 'editCliente'])->name('clientes.edit');
        Route::put('/clientes/{id}', [EmpleadoController::class, 'updateCliente'])->name('clientes.update');
        Route::delete('/clientes/{id}', [EmpleadoController::class, 'destroyCliente'])->name('clientes.destroy');

        Route::get('/contratos', [EmpleadoController::class, 'contratos'])->name('contratos');
        Route::post('/contratos', [EmpleadoController::class, 'storeContrato'])->name('contratos.store');
        Route::get('/contratos/{id}/edit', [EmpleadoController::class, 'editContrato'])->name('contratos.edit');
        Route::put('/contratos/{id}', [EmpleadoController::class, 'updateContrato'])->name('contratos.update');
        Route::delete('/contratos/{id}', [EmpleadoController::class, 'destroyContrato'])->name('contratos.destroy');
    });

    /**
     * Rutas para Usuarios Finales
     */
    Route::middleware(['role:usuario,empleado,administrador'])->prefix('usuario')->name('usuario.')->group(function () {
        Route::get('/dashboard', [UsuarioController::class, 'dashboard'])->name('dashboard');
        Route::get('/propiedades', [UsuarioController::class, 'propiedades'])->name('propiedades');
        Route::get('/contratos', [UsuarioController::class, 'contratos'])->name('contratos');
    });
});