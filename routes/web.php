<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EmpleadoUsuarioController; // <-- Asegurate de tener esto

Route::middleware(['web'])->group(function () {
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
});

Route::middleware(['web', 'auth'])->group(function () {

    // Rutas para administrador
    Route::middleware(['role:Administrador'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('usuarios.index');
        Route::get('/usuarios/create', [AdminController::class, 'createUsuario'])->name('usuarios.create');
        Route::post('/usuarios', [AdminController::class, 'storeUsuario'])->name('usuarios.store');
        Route::get('/usuarios/{id}/edit', [AdminController::class, 'editUsuario'])->name('usuarios.edit');
        Route::put('/usuarios/{id}', [AdminController::class, 'updateUsuario'])->name('usuarios.update');
        Route::delete('/usuarios/{id}', [AdminController::class, 'destroyUsuario'])->name('usuarios.destroy');
        Route::get('/empleados', [AdminController::class, 'empleados'])->name('empleados.index');
        Route::get('/empleados/create', [AdminController::class, 'createEmpleado'])->name('empleados.create');
        Route::post('/empleados', [AdminController::class, 'storeEmpleado'])->name('empleados.store');
        Route::get('/empleados/{id}/edit', [AdminController::class, 'editEmpleado'])->name('empleados.edit');
        Route::get('/empleados/{id}', [AdminController::class, 'showEmpleado'])->name('empleados.show');
        Route::put('/empleados/{id}', [AdminController::class, 'updateEmpleado'])->name('empleados.update');
        Route::delete('/empleados/{id}', [AdminController::class, 'destroyEmpleado'])->name('empleados.destroy');
        Route::get('/reportes', [AdminController::class, 'reportes'])->name('reportes');
        
        // CRUD de propiedades para administrador
        Route::get('/propiedades', [AdminController::class, 'propiedades'])->name('propiedades.index');
        Route::get('/propiedades/create', [AdminController::class, 'createPropiedad'])->name('propiedades.create');
        Route::post('/propiedades', [AdminController::class, 'storePropiedad'])->name('propiedades.store');
        Route::get('/propiedades/{id}', [AdminController::class, 'showPropiedad'])->name('propiedades.show');
        Route::get('/propiedades/{id}/edit', [AdminController::class, 'editPropiedad'])->name('propiedades.edit');
        Route::put('/propiedades/{id}', [AdminController::class, 'updatePropiedad'])->name('propiedades.update');
        Route::delete('/propiedades/{id}', [AdminController::class, 'destroyPropiedad'])->name('propiedades.destroy');
        
        // CRUD de clientes para administrador
        Route::get('/clientes', [AdminController::class, 'clientes'])->name('clientes.index');
        Route::get('/clientes/create', [AdminController::class, 'createCliente'])->name('clientes.create');
        Route::post('/clientes', [AdminController::class, 'storeCliente'])->name('clientes.store');
        Route::get('/clientes/{id}', [AdminController::class, 'showCliente'])->name('clientes.show');
        Route::get('/clientes/{id}/edit', [AdminController::class, 'editCliente'])->name('clientes.edit');
        Route::put('/clientes/{id}', [AdminController::class, 'updateCliente'])->name('clientes.update');
        Route::delete('/clientes/{id}', [AdminController::class, 'destroyCliente'])->name('clientes.destroy');
        
        // CRUD de contratos para administrador
        Route::get('/contratos', [AdminController::class, 'contratos'])->name('contratos.index');
        Route::get('/contratos/create', [AdminController::class, 'createContrato'])->name('contratos.create');
        Route::post('/contratos', [AdminController::class, 'storeContrato'])->name('contratos.store');
        Route::get('/contratos/{id}', [AdminController::class, 'showContrato'])->name('contratos.show');
        Route::get('/contratos/{id}/edit', [AdminController::class, 'editContrato'])->name('contratos.edit');
        Route::put('/contratos/{id}', [AdminController::class, 'updateContrato'])->name('contratos.update');
        Route::delete('/contratos/{id}', [AdminController::class, 'destroyContrato'])->name('contratos.destroy');
    });

    // Rutas para empleados (y administradores)
    Route::middleware(['role:Empleado,Administrador'])->prefix('empleado')->name('empleado.')->group(function () {
        Route::get('/dashboard', [EmpleadoController::class, 'dashboard'])->name('dashboard');

        // CRUD de propiedades
        Route::get('/propiedades', [EmpleadoController::class, 'propiedades'])->name('propiedades.index');
        Route::get('/propiedades/create', [EmpleadoController::class, 'createPropiedad'])->name('propiedades.create');
        Route::post('/propiedades', [EmpleadoController::class, 'storePropiedad'])->name('propiedades.store');
        Route::get('/propiedades/{id}', [EmpleadoController::class, 'showPropiedad'])->name('propiedades.show');
        Route::get('/propiedades/{id}/edit', [EmpleadoController::class, 'editPropiedad'])->name('propiedades.edit');
        Route::put('/propiedades/{id}', [EmpleadoController::class, 'updatePropiedad'])->name('propiedades.update');
        Route::delete('/propiedades/{id}', [EmpleadoController::class, 'destroyPropiedad'])->name('propiedades.destroy');

        // CRUD de clientes
        Route::get('/clientes', [EmpleadoController::class, 'clientes'])->name('clientes.index');
        Route::get('/clientes/create', [EmpleadoController::class, 'createCliente'])->name('clientes.create');
        Route::post('/clientes', [EmpleadoController::class, 'storeCliente'])->name('clientes.store');
        Route::get('/clientes/{id}', [EmpleadoController::class, 'showCliente'])->name('clientes.show');
        Route::get('/clientes/{id}/edit', [EmpleadoController::class, 'editCliente'])->name('clientes.edit');
        Route::put('/clientes/{id}', [EmpleadoController::class, 'updateCliente'])->name('clientes.update');
        Route::delete('/clientes/{id}', [EmpleadoController::class, 'destroyCliente'])->name('clientes.destroy');

        // CRUD de contratos
        Route::get('/contratos', [EmpleadoController::class, 'contratos'])->name('contratos.index');
        Route::get('/contratos/create', [EmpleadoController::class, 'createContrato'])->name('contratos.create');
        Route::post('/contratos', [EmpleadoController::class, 'storeContrato'])->name('contratos.store');
        Route::get('/contratos/{id}', [EmpleadoController::class, 'showContrato'])->name('contratos.show');
        Route::get('/contratos/{id}/edit', [EmpleadoController::class, 'editContrato'])->name('contratos.edit');
        Route::put('/contratos/{id}', [EmpleadoController::class, 'updateContrato'])->name('contratos.update');
        Route::delete('/contratos/{id}', [EmpleadoController::class, 'destroyContrato'])->name('contratos.destroy');

        //  CRUD de usuarios normales (solo role_id = 1)
        Route::get('/usuarios', [EmpleadoUsuarioController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/create', [EmpleadoUsuarioController::class, 'create'])->name('usuarios.create');
        Route::post('/usuarios', [EmpleadoUsuarioController::class, 'store'])->name('usuarios.store');
        Route::get('/usuarios/{id}/edit', [EmpleadoUsuarioController::class, 'edit'])->name('usuarios.edit');
        Route::put('/usuarios/{id}', [EmpleadoUsuarioController::class, 'update'])->name('usuarios.update');
        Route::delete('/usuarios/{id}', [EmpleadoUsuarioController::class, 'destroy'])->name('usuarios.destroy');
    });

    // Rutas accesibles por cualquier usuario autenticado
    Route::middleware(['role:Usuario,Empleado,Administrador'])->prefix('usuario')->name('usuario.')->group(function () {
        Route::get('/dashboard', [UsuarioController::class, 'dashboard'])->name('dashboard');
        Route::get('/propiedades', [UsuarioController::class, 'propiedades'])->name('propiedades');
        Route::get('/contratos', [UsuarioController::class, 'contratos'])->name('contratos');
    });
});