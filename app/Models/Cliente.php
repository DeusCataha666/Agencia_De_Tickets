<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'estado',
        'registrado_por',
    ];

    // Relación con ticket(1:N)
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'cliente_id');
    }

}
