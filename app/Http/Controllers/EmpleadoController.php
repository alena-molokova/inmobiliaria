<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Propiedad;
use App\Models\Contrato;
use App\Models\Cliente;

class EmpleadoController extends Controller
{
    // DASHBOARD
    public function dashboard()
    {
        return view('empleado.dashboard');
    }

    // ==================== PROPIEDADES ====================

    public function propiedades()
    {
        $propiedades = Propiedad::all();
        return view('empleado.propiedades.index', compact('propiedades'));
    }

    public function createPropiedad()
    {
        return view('empleado.propiedades.create');
    }

    public function showPropiedad($id)
    {
        $propiedad = Propiedad::findOrFail($id);
        return view('empleado.propiedades.show', compact('propiedad'));
    }

    public function storePropiedad(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'property_type' => 'required|in:Casa,Apartamento,Terreno,Comercial,Dúplex',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'nullable|in:Disponible,Vendido,Alquilado,Pendiente',
        ]);

        $validated['employee_id'] = auth()->id(); 

        Propiedad::create($validated);

        return redirect()->route('empleado.propiedades.index')->with('success', 'Propiedad creada correctamente.');
    }

    public function editPropiedad($id)
    {
        $propiedad = Propiedad::findOrFail($id);
        return view('empleado.editar_propiedad', compact('propiedad'));
    }

    public function updatePropiedad(Request $request, $id)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'price' => 'required|numeric',
            'property_type' => 'required|string|max:100',
        ]);

        $propiedad = Propiedad::findOrFail($id);
        $propiedad->update($request->only(['address', 'price', 'property_type']));

        return redirect()->route('empleado.propiedades.index')->with('success', 'Propiedad actualizada.');
    }

    public function destroyPropiedad($id)
    {
        $propiedad = Propiedad::findOrFail($id);
        $propiedad->delete();

        return redirect()->route('empleado.propiedades.index')->with('success', 'Propiedad eliminada.');
    }

    // ==================== CLIENTES ====================

    public function clientes()
    {
        $clientes = Cliente::all();
        return view('empleado.clientes.index', compact('clientes'));
    }

    public function createCliente()
    {
        return view('empleado.clientes.create');
    }

    public function showCliente($id)
    {
        $cliente = Cliente::with('contratos.propiedad')->findOrFail($id);
        return view('empleado.clientes.show', compact('cliente'));
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

        Cliente::create([
            'first_name' => trim($validated['first_name']),
            'last_name' => trim($validated['last_name']),
            'email' => strtolower(trim($validated['email'])),
            'phone' => $validated['phone'] ? trim($validated['phone']) : null,
            'address' => $validated['address'] ? trim($validated['address']) : null,
        ]);

        return redirect()->route('empleado.clientes.index')->with('success', 'Cliente agregado.');
    }

    public function editCliente($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('empleado.editar_cliente', compact('cliente'));
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

        $cliente = Cliente::findOrFail($id);
        $cliente->update([
            'first_name' => trim($validated['first_name']),
            'last_name' => trim($validated['last_name']),
            'email' => strtolower(trim($validated['email'])),
            'phone' => $validated['phone'] ? trim($validated['phone']) : null,
            'address' => $validated['address'] ? trim($validated['address']) : null,
        ]);

        return redirect()->route('empleado.clientes.index')->with('success', 'Cliente actualizado.');
    }

    public function destroyCliente($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('empleado.clientes.index')->with('success', 'Cliente eliminado.');
    }

    // ==================== CONTRATOS ====================

   public function contratos()
    {
        $clientes = Cliente::all();
        $propiedades = Propiedad::all();
        $contratos = Contrato::with(['cliente', 'propiedad'])->get();

        return view('empleado.contratos.index', compact('clientes', 'propiedades', 'contratos'));
    }

    public function createContrato()
    {
        $clientes = Cliente::all();
        $propiedades = Propiedad::all();
        return view('empleado.contratos.create', compact('clientes', 'propiedades'));
    }

    public function showContrato($id)
    {
        $contrato = Contrato::with(['cliente', 'propiedad'])->findOrFail($id);
        return view('empleado.contratos.show', compact('contrato'));
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
        ], [
            'client_id.exists' => 'El cliente seleccionado no existe.',
            'property_id.exists' => 'La propiedad seleccionada no existe.',
            'start_date.after_or_equal' => 'La fecha de inicio debe ser hoy o una fecha futura.',
            'end_date.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
            'amount.min' => 'El monto debe ser mayor a 0.',
            'amount.max' => 'El monto no puede exceder $999,999,999.99.',
        ]);

        Contrato::create([
            'client_id' => $validated['client_id'],
            'property_id' => $validated['property_id'],
            'contract_type' => $validated['contract_type'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'amount' => $validated['amount'],
            'status' => $validated['status'],
            'user_id' => auth()->id(), // Asignar al usuario autenticado
        ]);

        return redirect()->route('empleado.contratos.index')->with('success', 'Contrato agregado correctamente');
    }

    public function editContrato($id)
    {
        $contrato = Contrato::findOrFail($id);
        $clientes = Cliente::all();
        $propiedades = Propiedad::all();
        return view('empleado.editar_contrato', compact('contrato', 'clientes', 'propiedades'));
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
        ], [
            'client_id.exists' => 'El cliente seleccionado no existe.',
            'property_id.exists' => 'La propiedad seleccionada no existe.',
            'end_date.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
            'amount.min' => 'El monto debe ser mayor a 0.',
            'amount.max' => 'El monto no puede exceder $999,999,999.99.',
        ]);

        $contrato = Contrato::findOrFail($id);
        $contrato->update([
            'client_id' => $validated['client_id'],
            'property_id' => $validated['property_id'],
            'contract_type' => $validated['contract_type'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'amount' => $validated['amount'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('empleado.contratos.index')->with('success', 'Contrato actualizado.');
    }

    public function destroyContrato($id)
    {
        $contrato = Contrato::findOrFail($id);
        $contrato->delete();

        return redirect()->route('empleado.contratos.index')->with('success', 'Contrato eliminado.');
    }
}
