<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if (request()->isMethod('post')) {
            return [
                'titulo'              => 'required|string|max:255',
                'descripcion'         => 'nullable|string',
                'imagen'              => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                'cliente_id'          => 'required|exists:clientes,id',
                'usuario_asignado_id' => 'nullable|exists:usuarios,id',
                'fecha_creacion'      => 'nullable|date',
                'fecha_cierre'        => 'nullable|date|after_or_equal:fecha_creacion',
                'estado'              => 'nullable|boolean',
                'registrado_por'      => 'nullable|integer',
            ];
        } elseif (request()->isMethod('put')) {
            return [
                'titulo'              => 'required|string|max:255',
                'descripcion'         => 'nullable|string',
                'imagen'              => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                'cliente_id'          => 'required|exists:clientes,id',
                'usuario_asignado_id' => 'nullable|exists:usuarios,id',
                'fecha_creacion'      => 'nullable|date',
                'fecha_cierre'        => 'nullable|date|after_or_equal:fecha_creacion',
                'estado'              => 'nullable|boolean',
                'registrado_por'      => 'nullable|integer',
            ];
        }

        return [];
    }

    public function messages(): array
    {
        return [
            'titulo.required'             => 'El título es obligatorio.',
            'titulo.max'                  => 'El título no puede superar 255 caracteres.',
            'cliente_id.required'         => 'Debe seleccionar un cliente.',
            'cliente_id.exists'           => 'El cliente seleccionado no existe.',
            'usuario_asignado_id.exists'  => 'El usuario asignado no existe.',
            'fecha_cierre.after_or_equal' => 'La fecha de cierre debe ser igual o posterior a la de creación.',
        ];
    }
}
