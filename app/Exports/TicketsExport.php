<?php

namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TicketsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Ticket::with('cliente')
            ->get()
            ->map(function (Ticket $ticket) {
                return [
                    $ticket->id,
                    $ticket->cliente->nombre ?? 'N/A',
                    $ticket->titulo,
                    $ticket->estado ? 'Activo' : 'Inactivo',
                    $ticket->created_at->format('d/m/Y H:i'),
                ];
            });
    }

    public function headings(): array
    {
        return ['ID', 'Cliente', 'Título', 'Estado', 'Fecha'];
    }
}
