<?php

namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TicketExport implements FromArray, WithHeadings
{
    protected $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function array(): array
    {
        return [
            [
                $this->ticket->id,
                $this->ticket->cliente->nombre ?? 'N/A',
                $this->ticket->titulo,
                $this->ticket->estado ? 'Activo' : 'Inactivo',
                $this->ticket->created_at->format('d/m/Y H:i'),
            ]
        ];
    }

    public function headings(): array
    {
        return ['ID', 'Cliente', 'Título', 'Estado', 'Fecha'];
    }
}
