<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;

    protected $primaryKey = 'client_id';
    protected $table = 'clientes';

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'address'
    ];

    public $timestamps = true;

    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'client_id', 'client_id');
    }

    public function getNombreCompletoAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}