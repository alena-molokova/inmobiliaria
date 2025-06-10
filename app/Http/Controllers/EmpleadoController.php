<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Propiedad;
use App\Models\Contrato;
use App\Models\Cliente;

class EmpleadoController extends Controller
{
    public function dashboard()
    {
        return view('empleado.dashboard');
    }

    public function propiedades()
    {
        $propiedades = Propiedad::all();
        return view('empleado.propiedades', compact('propiedades'));
    }

    public function storePropiedad(Request $request)
    {
        $request->validate([
            'direccion' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'tipo' => 'required|string|max:100',
        ]);

        Propiedad::create($request->only(['direccion', 'precio', 'tipo']));

        return redirect()->route('empleado.propiedades')->with('success', 'Propiedad creada.');
    }

    public function clientes()
    {
        $clientes = Cliente::all();
        return view('empleado.clientes', compact('clientes'));
    }

    public function storeCliente(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:clientes',
        ]);

        Cliente::create($request->only(['nombre', 'email']));

        return redirect()->route('empleado.clientes')->with('success', 'Cliente agregado.');
    }

    public function contratos()
    {
        $contratos = Contrato::all();
        return view('empleado.contratos', compact('contratos'));
    }

    public function storeContrato(Request $request)
    {
        $request->validate([
            'cliente' => 'required|string|max:100',
            'propiedad' => 'required|string|max:255',
            'inicio' => 'required|date',
            'fin' => 'required|date|after:inicio',
        ]);

        Contrato::create($request->only(['cliente', 'propiedad', 'inicio', 'fin']));

        return redirect()->route('empleado.contratos')->with('success', 'Contrato registrado.');
    }
}
