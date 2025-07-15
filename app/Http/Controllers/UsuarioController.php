<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;
use App\Models\Propiedad;

class UsuarioController extends Controller
{
    public function dashboard()
    {
        return view('usuario.dashboard');
    }

    public function contratos()
    {
        $contratos = Contrato::with(['propiedad', 'cliente'])
            ->where('user_id', auth()->id())
            ->get();
        
        return view('usuario.contratos', compact('contratos'));
    }

    public function propiedades(Request $request)
    {
        $query = Propiedad::disponible();

        if ($request->filled('city')) {
            $query->byCity($request->city);
        }

        if ($request->filled('property_type')) {
            $query->byType($request->property_type);
        }

        if ($request->filled('price_min') || $request->filled('price_max')) {
            $query->byPriceRange($request->price_min, $request->price_max);
        }

        $propiedades = $query->orderBy('created_at', 'desc')->paginate(12);

        $cities = Propiedad::distinct()->pluck('city')->sort();
        $propertyTypes = ['Casa', 'Apartamento', 'Terreno', 'Comercial', 'Dúplex'];

        return view('usuario.propiedades', compact('propiedades', 'cities', 'propertyTypes'));
    }

    public function showPropiedad($id)
    {
        $propiedad = Propiedad::with(['empleado', 'contratos.cliente'])
            ->where('status', 'Disponible')
            ->findOrFail($id);
        
        return view('usuario.propiedades.show', compact('propiedad'));
    }
}