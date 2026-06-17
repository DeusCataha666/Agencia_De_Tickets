<?php

namespace App\Exports;

use App\Models\Comentario;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ComentariosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Comentario::with(['ticket', 'usuario'])->get()->map(function (Comentario $comentario) {
            return [
                $comentario->id,
                $comentario->ticket->titulo ?? 'N/A',
                $comentario->usuario->nombre ?? 'N/A',
                $comentario->mensaje,
                $comentario->fecha ?? $comentario->created_at->format('d/m/Y H:i'),
                $comentario->estado ? 'Activo' : 'Inactivo',
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Ticket', 'Usuario', 'Mensaje', 'Fecha', 'Estado'];
    }
}
