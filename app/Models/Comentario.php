<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentarios';
    protected $primaryKey = 'id';

    protected $fillable = [
        'mensaje',
        'imagen',
        'fecha',
        'registrado_por',
        'estado',
        'ticket_id',
        'usuario_id',
    ];



    // Relación N:1 con ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    //  Relación N:1 con usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
