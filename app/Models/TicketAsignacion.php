<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketAsignacion extends Model
{
    use HasFactory;

    protected $table = 'ticket_asignaciones';

    protected $fillable = [
        'ticket_id',
        'usuario_id',
        'asignado_por',
        'fecha_asignacion',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function asignadoPor()
    {
        return $this->belongsTo(User::class, 'asignado_por');
    }
}
