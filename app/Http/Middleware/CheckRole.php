<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user()->load('role');

        if (!$user->role) {
            \Log::error('User without role', ['user_id' => $user->user_id]);
            abort(403, 'Usuario sin rol asignado.');
        }

        if (!in_array($user->role->role_name, $roles)) {
            \Log::warning('Unauthorized access attempt', [
                'user_id' => $user->user_id,
                'user_role' => $user->role->role_name,
                'required_roles' => $roles,
                'url' => $request->url()
            ]);
            abort(403, 'No tenés permiso para acceder a esta sección.');
        }

        return $next($request);
    }

   
    public function redirectToDashboard($user)
    {
        $roleName = $user->role->role_name ?? '';

        switch ($roleName) {
            case 'Administrador':
                return redirect()->route('admin.dashboard');
            case 'Empleado':
                return redirect()->route('empleado.dashboard');
            case 'Usuario':
                return redirect()->route('usuario.dashboard');
            default:
                return redirect()->route('login');
        }
    }
}
