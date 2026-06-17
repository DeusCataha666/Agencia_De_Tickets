<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    protected $primaryKey = 'id';

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'estado',
        'sector',
        'registrado_por',
        'fecha_creacion',
        'fecha_cierre',
        'cliente_id',
        'usuario_asignado_id',
    ];


    //Relación con cliente(N:1)
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    //Relación con usuario asignado (N:1)
    public function usuarioAsignado()
    {
        return $this->belongsTo(Usuario::class, 'usuario_asignado_id');
    }

    //Relación con comentarios(1:N)
    public function comentarios(){
        return $this->hasMany(Comentario::class,'ticket_id');
    }

    // Historial de asignaciones (1:N)
    public function asignaciones()
    {
        return $this->hasMany(TicketAsignacion::class, 'ticket_id')->orderBy('fecha_asignacion', 'desc');
    }

    // Historial de cambios de estado/sector (1:N)
    public function historiales()
    {
        return $this->hasMany(TicketHistorial::class, 'ticket_id')->orderBy('created_at', 'desc');
    }
}