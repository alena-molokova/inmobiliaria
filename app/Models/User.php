<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';
    
    protected $fillable = [
        'email', 
        'password', 
        'first_name', 
        'last_name', 
        'phone', 
        'role_id'
    ];
    
    protected $hidden = [
        'password', 
        'remember_token'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'created_at' => 'datetime',
        ];
    }

    public function hasRole($role)
    {
        return $this->role && $this->role->role_name === ucfirst($role);
    }

    public function hasAnyRole($roles)
    {
        if (!$this->role) return false;
        
        if (is_string($roles)) {
            $roles = explode(',', $roles);
        }
        return in_array($this->role->role_name, array_map('ucfirst', $roles));
    }

    public function isAdmin()
    {
        return $this->role && $this->role->role_name === 'Administrador';
    }

    public function isEmpleado()
    {
        return $this->role && $this->role->role_name === 'Empleado';
    }

    public function isUsuario()
    {
        return $this->role && $this->role->role_name === 'Usuario';
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    public function propiedades()
    {
        return $this->hasMany(Propiedad::class, 'employee_id', 'user_id');
    }

    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'user_id', 'user_id');
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}