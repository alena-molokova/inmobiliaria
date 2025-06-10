<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Propiedad extends Model
{
    use HasFactory;

    protected $primaryKey = 'property_id';
    protected $table = 'propiedades';

    protected $fillable = [
        'address', 'city', 'property_type', 'price', 'description', 'status', 'employee_id'
    ];

    public $timestamps = true;

    public function empleado()
    {
        return $this->belongsTo(User::class, 'employee_id', 'user_id');
    }

    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'property_id', 'property_id');
    }
}
