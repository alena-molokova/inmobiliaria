<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmpleadoUsuarioController extends Controller
{
    /**
     * Показать список пользователей (только с role_id = 1 - Usuario)
     */
    public function index()
    {
        $usuarios = User::where('role_id', 1)->get();
        return view('empleado.usuarios.index', compact('usuarios'));
    }

    /**
     * Показать форму создания пользователя
     */
    public function create()
    {
        return view('empleado.usuarios.create');
    }

    /**
     * Сохранить нового пользователя
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'last_name' => 'required|string|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'email' => 'required|email|max:100|unique:users,email',
            'phone' => 'nullable|string|max:20|regex:/^[\d\-\+\(\)\s]+$/',
            'password' => 'required|string|min:8|max:255|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/',
        ], [
            'first_name.regex' => 'El nombre solo puede contener letras y espacios.',
            'last_name.regex' => 'El apellido solo puede contener letras y espacios.',
            'email.unique' => 'Este email ya está registrado.',
            'phone.regex' => 'El teléfono solo puede contener números, guiones, paréntesis y espacios.',
            'password.regex' => 'La contraseña debe contener al menos una letra minúscula, una mayúscula y un número.',
        ]);

        $user = User::create([
            'first_name' => trim($validated['first_name']),
            'last_name' => trim($validated['last_name']),
            'email' => strtolower(trim($validated['email'])),
            'phone' => $validated['phone'] ? trim($validated['phone']) : null,
            'password' => Hash::make($validated['password']),
            'role_id' => 1, // Usuario
        ]);

        return redirect()->route('empleado.usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Показать форму редактирования пользователя
     */
    public function edit($id)
    {
        $usuario = User::where('role_id', 1)->findOrFail($id);
        return view('empleado.usuarios.edit', compact('usuario'));
    }

    /**
     * Обновить пользователя
     */
    public function update(Request $request, $id)
    {
        $usuario = User::where('role_id', 1)->findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'last_name' => 'required|string|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'email' => 'required|email|max:100|unique:users,email,' . $id . ',user_id',
            'phone' => 'nullable|string|max:20|regex:/^[\d\-\+\(\)\s]+$/',
            'password' => 'nullable|string|min:8|max:255|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/',
        ], [
            'first_name.regex' => 'El nombre solo puede contener letras y espacios.',
            'last_name.regex' => 'El apellido solo puede contener letras y espacios.',
            'email.unique' => 'Este email ya está registrado.',
            'phone.regex' => 'El teléfono solo puede contener números, guiones, paréntesis y espacios.',
            'password.regex' => 'La contraseña debe contener al menos una letra minúscula, una mayúscula y un número.',
        ]);

        $data = [
            'first_name' => trim($validated['first_name']),
            'last_name' => trim($validated['last_name']),
            'email' => strtolower(trim($validated['email'])),
            'phone' => $validated['phone'] ? trim($validated['phone']) : null,
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $usuario->update($data);

        return redirect()->route('empleado.usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Удалить пользователя
     */
    public function destroy($id)
    {
        $usuario = User::where('role_id', 1)->findOrFail($id);
        $usuario->delete();

        return redirect()->route('empleado.usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
} 