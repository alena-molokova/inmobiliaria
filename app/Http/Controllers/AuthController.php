<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'role' => 'required|in:Usuario,Empleado,Administrador',
        ]);

        $userCredentials = [
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ];

        if (Auth::attempt($userCredentials)) {
            $request->session()->regenerate();

            $user = Auth::user()->load('role');

            if (!$user->role) {
                \Log::error('User role not found after login', ['user_id' => $user->user_id]);
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Error al obtener el rol del usuario.',
                ])->onlyInput('email');
            }

            $roleName = $user->role->role_name; 

            if ($credentials['role'] !== $roleName) {
                Auth::logout();
                return back()->withErrors([
                    'role' => 'El rol seleccionado no coincide con el usuario.',
                ])->onlyInput('email', 'role');
            }

            switch ($roleName) {
                case 'Administrador':
                    return redirect()->route('admin.dashboard');
                case 'Empleado':
                    return redirect()->route('empleado.dashboard');
                case 'Usuario':
                    return redirect()->route('usuario.dashboard');
                default:
                    Auth::logout();
                    return back()->withErrors([
                        'role' => 'Rol no reconocido.',
                    ]);
            }
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email', 'role');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $roleId = 1;

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $roleId,
        ]);

        Auth::login($user);

        $user = Auth::user()->fresh(['role']);

        if (!$user->role) {
            \Log::error('User role not found after registration', ['user_id' => $user->user_id]);
            return redirect()->route('login')->with('error', 'Error en el registro. Intente nuevamente.');
        }

        if ($user->role->role_name !== 'Usuario') {
            \Log::warning('Registro con rol distinto a usuario', ['user_id' => $user->user_id, 'role' => $user->role->role_name]);
            Auth::logout();
            return redirect()->route('login')->with('error', 'No tienes permiso para acceder.');
        }

        return redirect()->route('usuario.dashboard')->with('success', '¡Registro exitoso! Bienvenido.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}