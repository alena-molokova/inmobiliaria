<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $empleados = User::with('role')->whereHas('role', fn($q) => $q->whereIn('role_name', ['Empleado', 'Administrador']))->get();
        return view('admin.empleados', compact('empleados'));
    }

    // ==================== CRUD EMPLEADOS ====================

    public function createEmpleado()
    {
        $roles = \App\Models\Role::whereIn('role_name', ['Empleado', 'Administrador'])->get();
        return view('admin.empleados.create', compact('roles'));
    }

    public function storeEmpleado(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'last_name' => 'required|string|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:8|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/',
            'role_id' => 'required|exists:roles,role_id',
        ], [
            'first_name.regex' => 'El nombre solo puede contener letras y espacios.',
            'last_name.regex' => 'El apellido solo puede contener letras y espacios.',
            'email.unique' => 'Este email ya está registrado.',
            'password.regex' => 'La contraseña debe contener al menos una letra minúscula, una mayúscula y un número.',
            'role_id.exists' => 'El rol seleccionado no existe.',
        ]);

        $user = User::create([
            'first_name' => trim($validated['first_name']),
            'last_name' => trim($validated['last_name']),
            'email' => strtolower(trim($validated['email'])),
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
        ]);

        return redirect()->route('admin.empleados.index')->with('success', 'Empleado creado correctamente.');
    }

    public function editEmpleado($id)
    {
        $empleado = User::findOrFail($id);
        $roles = \App\Models\Role::whereIn('role_name', ['Empleado', 'Administrador'])->get();
        return view('admin.empleados.edit', compact('empleado', 'roles'));
    }

    public function showEmpleado($id)
    {
        $empleado = User::with('role')->findOrFail($id);
        return view('admin.empleados.show', compact('empleado'));
    }

    public function updateEmpleado(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'last_name' => 'required|string|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'email' => 'required|email|max:100|unique:users,email,' . $id . ',user_id',
            'role_id' => 'required|exists:roles,role_id',
        ], [
            'first_name.regex' => 'El nombre solo puede contener letras y espacios.',
            'last_name.regex' => 'El apellido solo puede contener letras y espacios.',
            'email.unique' => 'Este email ya está registrado.',
            'role_id.exists' => 'El rol seleccionado no existe.',
        ]);

        $empleado = User::findOrFail($id);
        $empleado->update([
            'first_name' => trim($validated['first_name']),
            'last_name' => trim($validated['last_name']),
            'email' => strtolower(trim($validated['email'])),
            'role_id' => $validated['role_id'],
        ]);

        return redirect()->route('admin.empleados.index')->with('success', 'Empleado actualizado correctamente.');
    }

    public function destroyEmpleado($id)
    {
        $empleado = User::findOrFail($id);
        $empleado->delete();

        return redirect()->route('admin.empleados.index')->with('success', 'Empleado eliminado correctamente.');
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
        $propiedades = Propiedad::with('empleado')->get();
        return view('admin.propiedades', compact('propiedades'));
    }

    public function clientes()
    {
        $clientes = \App\Models\Cliente::withCount('contratos')->get();
        return view('admin.clientes', compact('clientes'));
    }

    public function contratos()
    {
        $contratos = Contrato::with(['usuario', 'propiedad', 'cliente'])->get();
        return view('admin.contratos', compact('contratos'));
    }

    // ==================== CRUD PROPIEDADES ====================

    public function createPropiedad()
    {
        $empleados = User::whereHas('role', fn($q) => $q->where('role_name', 'Empleado'))->get();
        return view('admin.propiedades.create', compact('empleados'));
    }

    public function storePropiedad(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'property_type' => 'required|in:Casa,Apartamento,Terreno,Comercial,Dúplex',
            'price' => 'required|numeric|min:0.01|max:999999999.99',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|in:Disponible,Vendido,Alquilado,Pendiente',
            'employee_id' => 'nullable|exists:users,user_id',
        ], [
            'price.min' => 'El precio debe ser mayor a 0.',
            'price.max' => 'El precio no puede exceder $999,999,999.99.',
            'employee_id.exists' => 'El empleado seleccionado no existe.',
        ]);

        Propiedad::create($validated);

        return redirect()->route('admin.propiedades.index')->with('success', 'Propiedad creada correctamente.');
    }

    public function showPropiedad($id)
    {
        $propiedad = Propiedad::with(['empleado', 'contratos.cliente'])->findOrFail($id);
        return view('admin.propiedades.show', compact('propiedad'));
    }

    public function editPropiedad($id)
    {
        $propiedad = Propiedad::findOrFail($id);
        $empleados = User::whereHas('role', fn($q) => $q->where('role_name', 'Empleado'))->get();
        return view('admin.propiedades.edit', compact('propiedad', 'empleados'));
    }

    public function updatePropiedad(Request $request, $id)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'property_type' => 'required|in:Casa,Apartamento,Terreno,Comercial,Dúplex',
            'price' => 'required|numeric|min:0.01|max:999999999.99',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|in:Disponible,Vendido,Alquilado,Pendiente',
            'employee_id' => 'nullable|exists:users,user_id',
        ], [
            'price.min' => 'El precio debe ser mayor a 0.',
            'price.max' => 'El precio no puede exceder $999,999,999.99.',
            'employee_id.exists' => 'El empleado seleccionado no existe.',
        ]);

        $propiedad = Propiedad::findOrFail($id);
        $propiedad->update($validated);

        return redirect()->route('admin.propiedades.index')->with('success', 'Propiedad actualizada correctamente.');
    }

    public function destroyPropiedad($id)
    {
        $propiedad = Propiedad::findOrFail($id);
        $propiedad->delete();

        return redirect()->route('admin.propiedades.index')->with('success', 'Propiedad eliminada correctamente.');
    }

    // ==================== CRUD CLIENTES ====================

    public function createCliente()
    {
        return view('admin.clientes.create');
    }

    public function storeCliente(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'last_name' => 'required|string|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'email' => 'required|email|max:100|unique:clientes,email',
            'phone' => 'nullable|string|max:20|regex:/^[\d\-\+\(\)\s]+$/',
            'address' => 'nullable|string|max:255',
        ], [
            'first_name.regex' => 'El nombre solo puede contener letras y espacios.',
            'last_name.regex' => 'El apellido solo puede contener letras y espacios.',
            'email.unique' => 'Este email ya está registrado.',
            'phone.regex' => 'El teléfono solo puede contener números, guiones, paréntesis y espacios.',
        ]);

        \App\Models\Cliente::create([
            'first_name' => trim($validated['first_name']),
            'last_name' => trim($validated['last_name']),
            'email' => strtolower(trim($validated['email'])),
            'phone' => $validated['phone'] ? trim($validated['phone']) : null,
            'address' => $validated['address'] ? trim($validated['address']) : null,
        ]);

        return redirect()->route('admin.clientes.index')->with('success', 'Cliente creado correctamente.');
    }

    public function showCliente($id)
    {
        $cliente = \App\Models\Cliente::with(['contratos.propiedad'])->findOrFail($id);
        return view('admin.clientes.show', compact('cliente'));
    }

    public function editCliente($id)
    {
        $cliente = \App\Models\Cliente::findOrFail($id);
        return view('admin.clientes.edit', compact('cliente'));
    }

    public function updateCliente(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'last_name' => 'required|string|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'email' => 'required|email|max:100|unique:clientes,email,' . $id . ',client_id',
            'phone' => 'nullable|string|max:20|regex:/^[\d\-\+\(\)\s]+$/',
            'address' => 'nullable|string|max:255',
        ], [
            'first_name.regex' => 'El nombre solo puede contener letras y espacios.',
            'last_name.regex' => 'El apellido solo puede contener letras y espacios.',
            'email.unique' => 'Este email ya está registrado.',
            'phone.regex' => 'El teléfono solo puede contener números, guiones, paréntesis y espacios.',
        ]);

        $cliente = \App\Models\Cliente::findOrFail($id);
        $cliente->update([
            'first_name' => trim($validated['first_name']),
            'last_name' => trim($validated['last_name']),
            'email' => strtolower(trim($validated['email'])),
            'phone' => $validated['phone'] ? trim($validated['phone']) : null,
            'address' => $validated['address'] ? trim($validated['address']) : null,
        ]);

        return redirect()->route('admin.clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroyCliente($id)
    {
        $cliente = \App\Models\Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('admin.clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }

    // ==================== CRUD CONTRATOS ====================

    public function createContrato()
    {
        $clientes = \App\Models\Cliente::all();
        $propiedades = Propiedad::all();
        $empleados = User::whereHas('role', fn($q) => $q->where('role_name', 'Empleado'))->get();
        return view('admin.contratos.create', compact('clientes', 'propiedades', 'empleados'));
    }

    public function storeContrato(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clientes,client_id',
            'property_id' => 'required|exists:propiedades,property_id',
            'contract_type' => 'required|in:Alquiler,Venta',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'nullable|date|after:start_date',
            'amount' => 'required|numeric|min:0.01|max:999999999.99',
            'status' => 'required|in:Activo,Pendiente,Terminado,Cancelado',
            'user_id' => 'required|exists:users,user_id',
        ], [
            'client_id.exists' => 'El cliente seleccionado no existe.',
            'property_id.exists' => 'La propiedad seleccionada no existe.',
            'start_date.after_or_equal' => 'La fecha de inicio debe ser hoy o una fecha futura.',
            'end_date.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
            'amount.min' => 'El monto debe ser mayor a 0.',
            'amount.max' => 'El monto no puede exceder $999,999,999.99.',
            'user_id.exists' => 'El empleado seleccionado no existe.',
        ]);

        Contrato::create($validated);

        return redirect()->route('admin.contratos.index')->with('success', 'Contrato creado correctamente.');
    }

    public function showContrato($id)
    {
        $contrato = Contrato::with(['cliente', 'propiedad', 'usuario'])->findOrFail($id);
        return view('admin.contratos.show', compact('contrato'));
    }

    public function editContrato($id)
    {
        $contrato = Contrato::findOrFail($id);
        $clientes = \App\Models\Cliente::all();
        $propiedades = Propiedad::all();
        $empleados = User::whereHas('role', fn($q) => $q->where('role_name', 'Empleado'))->get();
        return view('admin.contratos.edit', compact('contrato', 'clientes', 'propiedades', 'empleados'));
    }

    public function updateContrato(Request $request, $id)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clientes,client_id',
            'property_id' => 'required|exists:propiedades,property_id',
            'contract_type' => 'required|in:Alquiler,Venta',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'amount' => 'required|numeric|min:0.01|max:999999999.99',
            'status' => 'required|in:Activo,Pendiente,Terminado,Cancelado',
            'user_id' => 'required|exists:users,user_id',
        ], [
            'client_id.exists' => 'El cliente seleccionado no existe.',
            'property_id.exists' => 'La propiedad seleccionada no existe.',
            'end_date.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
            'amount.min' => 'El monto debe ser mayor a 0.',
            'amount.max' => 'El monto no puede exceder $999,999,999.99.',
            'user_id.exists' => 'El empleado seleccionado no existe.',
        ]);

        $contrato = Contrato::findOrFail($id);
        $contrato->update($validated);

        return redirect()->route('admin.contratos.index')->with('success', 'Contrato actualizado correctamente.');
    }

    public function destroyContrato($id)
    {
        $contrato = Contrato::findOrFail($id);
        $contrato->delete();

        return redirect()->route('admin.contratos.index')->with('success', 'Contrato eliminado correctamente.');
    }

    // ==================== CRUD USUARIOS ====================

    public function createUsuario()
    {
        return view('admin.usuarios.create');
    }

    public function storeUsuario(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'last_name' => 'required|string|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:8|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/',
            'phone' => 'nullable|string|max:20',
        ], [
            'first_name.regex' => 'El nombre solo puede contener letras y espacios.',
            'last_name.regex' => 'El apellido solo puede contener letras y espacios.',
            'email.unique' => 'Este email ya está registrado.',
            'password.regex' => 'La contraseña debe contener al menos una letra minúscula, una mayúscula y un número.',
        ]);

        $user = User::create([
            'first_name' => trim($validated['first_name']),
            'last_name' => trim($validated['last_name']),
            'email' => strtolower(trim($validated['email'])),
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'role_id' => 1, // Usuario
        ]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function editUsuario($id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function updateUsuario(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'last_name' => 'required|string|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'email' => 'required|email|max:100|unique:users,email,' . $id . ',user_id',
            'phone' => 'nullable|string|max:20',
        ], [
            'first_name.regex' => 'El nombre solo puede contener letras y espacios.',
            'last_name.regex' => 'El apellido solo puede contener letras y espacios.',
            'email.unique' => 'Este email ya está registrado.',
        ]);

        $usuario = User::findOrFail($id);
        $usuario->update([
            'first_name' => trim($validated['first_name']),
            'last_name' => trim($validated['last_name']),
            'email' => strtolower(trim($validated['email'])),
            'phone' => $validated['phone'] ?? null,
        ]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroyUsuario($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
