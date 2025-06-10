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
        $contratos = Contrato::where('user_id', auth()->id())->get();
        return view('usuario.contratos', compact('contratos'));
    }

    public function propiedades()
    {
        $propiedades = Propiedad::all(); 
        return view('usuario.propiedades', compact('propiedades'));
    }
}
