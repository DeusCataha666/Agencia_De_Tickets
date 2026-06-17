<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComentarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if (request()->isMethod('post')) {
            return [
                'mensaje'        => 'required|string',
                'imagen'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'ticket_id'      => 'required|exists:tickets,id',
                'usuario_id'     => 'required|exists:usuarios,id',
                'fecha'          => 'nullable|date',
                'estado'         => 'nullable|boolean',
                'registrado_por' => 'nullable|integer',
            ];
        } elseif (request()->isMethod('put')) {
            return [
                'mensaje'        => 'required|string',
                'imagen'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'ticket_id'      => 'required|exists:tickets,id',
                'usuario_id'     => 'required|exists:usuarios,id',
                'fecha'          => 'nullable|date',
                'estado'         => 'nullable|boolean',
                'registrado_por' => 'nullable|integer',
            ];
        }

        return [];
    }

    public function messages(): array
    {
        return [
            'mensaje.required'    => 'El mensaje es obligatorio.',
            'imagen.image'        => 'El archivo debe ser una imagen.',
            'imagen.mimes'        => 'La imagen debe ser de tipo: jpeg, png, jpg, webp.',
            'imagen.max'          => 'La imagen no puede superar 2MB.',
            'ticket_id.required'  => 'Debe seleccionar un ticket.',
            'ticket_id.exists'    => 'El ticket seleccionado no existe.',
            'usuario_id.required' => 'Debe seleccionar un usuario.',
            'usuario_id.exists'   => 'El usuario seleccionado no existe.',
        ];
    }
}
