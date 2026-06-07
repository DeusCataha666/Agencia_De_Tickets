<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoUsuario extends Model
{
    use HasFactory;

    protected $table = 'tipo_usuarios';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre_tipo',
        'estado',
        'registrado_por',
    ];

    // Relación 1:N con usuarios
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'tipo_usuario_id');
    }
}
