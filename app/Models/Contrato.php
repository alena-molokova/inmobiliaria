<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contrato extends Model
{
    use HasFactory;

    protected $primaryKey = 'contract_id';
    protected $table = 'contratos';

    protected $fillable = [
        'user_id', 'property_id', 'client_id', 'contract_type',
        'start_date', 'end_date', 'amount', 'status'
    ];

    public $timestamps = true;

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'property_id', 'property_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'client_id', 'client_id');
    }
}
