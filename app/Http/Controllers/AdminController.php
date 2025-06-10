<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Propiedad;
use App\Models\Contrato;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function usuarios()
    {
        $usuarios = User::with('role')->whereHas('role', fn($q) => $q->where('role_name', 'Usuario'))->get();
        return view('admin.usuarios', compact('usuarios'));
    }

    public function empleados()
    {
        $empleados = User::with('role')->whereHas('role', fn($q) => $q->where('role_name', 'Empleado'))->get();
        return view('admin.empleados', compact('empleados'));
    }

    public function reportes()
    {
        return view('admin.reportes', [
            'totalUsuarios' => User::whereHas('role', fn($q) => $q->where('role_name', 'Usuario'))->count(),
            'totalEmpleados' => User::whereHas('role', fn($q) => $q->where('role_name', 'Empleado'))->count(),
            'totalAdmins' => User::whereHas('role', fn($q) => $q->where('role_name', 'Administrador'))->count(),
        ]);
    }

    public function propiedades()
    {
        $propiedades = Propiedad::all();
        return view('admin.propiedades', compact('propiedades'));
    }

    public function clientes()
    {
        $clientes = User::whereHas('role', fn($q) => $q->where('role_name', 'Usuario'))->get();
        return view('admin.clientes', compact('clientes'));
    }

    public function contratos()
    {
        $contratos = Contrato::with('usuario', 'propiedad')->get();
        return view('admin.contratos', compact('contratos'));
    }
}
