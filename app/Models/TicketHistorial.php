<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketHistorial extends Model
{
    use HasFactory;

    protected $table = 'ticket_historiales';
    protected $primaryKey = 'id';

    protected $fillable = [
        'ticket_id',
        'sector_anterior',
        'sector_nuevo',
        'estado_anterior',
        'estado_nuevo',
        'usuario_id',
        'motivo',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relación N:1 con Ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    // Relación N:1 con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
