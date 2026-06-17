<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'estado',
        'tipo_usuario_id',
        'registrado_por',
    ];

    // Relación inversa con tipo de usuario (N:1)
    public function tipoUsuario()
    {
        return $this->belongsTo(TipoUsuario::class, 'tipo_usuario_id');
    }

    // Relación 1:N con comentarios
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'usuario_id');
    }

    // Relación 1:N con tickets asignados
    public function ticketsAsignados()
    {
        return $this->hasMany(Ticket::class, 'usuario_asignado_id');
    }
}
