<?php

namespace App\Exports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Cliente::all()->map(function (Cliente $cliente) {
            return [
                $cliente->id,
                $cliente->nombre,
                $cliente->direccion ?? 'N/A',
                $cliente->telefono ?? 'N/A',
                $cliente->estado ? 'Activo' : 'Inactivo',
                $cliente->registrado_por ?? 'N/A',
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Nombre', 'Dirección', 'Teléfono', 'Estado', 'Registrado Por'];
    }
}
