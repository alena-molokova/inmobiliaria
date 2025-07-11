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
        ]);

        // Проверка на брутфорс атаку
        $email = $credentials['email'];
        $key = 'login_attempts_' . md5($email);
        $attempts = cache()->get($key, 0);
        
        if ($attempts >= 5) {
            $lockoutTime = cache()->get($key . '_lockout', 0);
            if (time() < $lockoutTime) {
                $remainingTime = $lockoutTime - time();
                return back()->withErrors([
                    'email' => "Demasiados intentos fallidos. Intenta nuevamente en {$remainingTime} segundos.",
                ])->onlyInput('email');
            } else {
                // Сброс блокировки
                cache()->forget($key);
                cache()->forget($key . '_lockout');
            }
        }

        if (Auth::attempt($credentials)) {
            // Сброс счетчика попыток при успешном входе
            cache()->forget($key);
            cache()->forget($key . '_lockout');
            
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
                        'email' => 'Rol no reconocido.',
                    ]);
            }
        }

        // Увеличение счетчика неудачных попыток
        $attempts++;
        cache()->put($key, $attempts, 300); // 5 минут
        
        if ($attempts >= 5) {
            $lockoutTime = time() + 300; // 5 минут блокировки
            cache()->put($key . '_lockout', $lockoutTime, 300);
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:50', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'last_name' => ['required', 'string', 'max:50', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/'],
        ], [
            'first_name.regex' => 'El nombre solo puede contener letras y espacios.',
            'last_name.regex' => 'El apellido solo puede contener letras y espacios.',
            'email.unique' => 'Este email ya está registrado.',
            'password.regex' => 'La contraseña debe contener al menos una letra minúscula, una mayúscula y un número.',
        ]);

        $roleId = 1;

        $user = User::create([
            'first_name' => trim($validated['first_name']),
            'last_name' => trim($validated['last_name']),
            'email' => strtolower(trim($validated['email'])),
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