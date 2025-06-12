<?php

namespace App\Http\Controllers;

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
        return view('empleado.propiedades', compact('propiedades'));
    }

    public function storePropiedad(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'price' => 'required|numeric',
            'property_type' => 'required|string|max:100',
        ]);

        Propiedad::create($request->only(['address', 'price', 'property_type']));

        return redirect()->route('empleado.propiedades')->with('success', 'Propiedad creada.');
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

        return redirect()->route('empleado.propiedades')->with('success', 'Propiedad actualizada.');
    }

    public function destroyPropiedad($id)
    {
        $propiedad = Propiedad::findOrFail($id);
        $propiedad->delete();

        return redirect()->route('empleado.propiedades')->with('success', 'Propiedad eliminada.');
    }

    // ==================== CLIENTES ====================

    public function clientes()
    {
        $clientes = Cliente::all();
        return view('empleado.clientes', compact('clientes'));
    }

    public function storeCliente(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:clientes',
        ]);

        Cliente::create($request->only(['first_name', 'last_name', 'email']));

        return redirect()->route('empleado.clientes')->with('success', 'Cliente agregado.');
    }

    public function editCliente($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('empleado.editar_cliente', compact('cliente'));
    }

    public function updateCliente(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:clientes,email,' . $id . ',client_id',
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->only(['first_name', 'last_name', 'email']));

        return redirect()->route('empleado.clientes')->with('success', 'Cliente actualizado.');
    }

    public function destroyCliente($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('empleado.clientes')->with('success', 'Cliente eliminado.');
    }

    // ==================== CONTRATOS ====================

    public function contratos()
    {
        $contratos = Contrato::with('cliente', 'propiedad')->get();
        $clientes = Cliente::all();
        $propiedades = Propiedad::all();
        return view('empleado.contratos', compact('contratos', 'clientes', 'propiedades'));
    }

    public function storeContrato(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clientes,client_id',
            'property_id' => 'required|exists:propiedades,property_id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        Contrato::create([
            'client_id' => $request->client_id,
            'property_id' => $request->property_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('empleado.contratos')->with('success', 'Contrato registrado.');
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
        $request->validate([
            'client_id' => 'required|exists:clientes,client_id',
            'property_id' => 'required|exists:propiedades,property_id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $contrato = Contrato::findOrFail($id);
        $contrato->update([
            'client_id' => $request->client_id,
            'property_id' => $request->property_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('empleado.contratos')->with('success', 'Contrato actualizado.');
    }

    public function destroyContrato($id)
    {
        $contrato = Contrato::findOrFail($id);
        $contrato->delete();

        return redirect()->route('empleado.contratos')->with('success', 'Contrato eliminado.');
    }
}
