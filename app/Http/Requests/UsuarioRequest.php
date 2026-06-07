<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if (request()->isMethod('post')) {
            return [
                'nombre'          => 'required|string|max:255',
                'tipo_usuario_id' => 'required|exists:tipo_usuarios,id',
                'estado'          => 'nullable|boolean',
                'registrado_por'  => 'nullable|integer',
            ];
        } elseif (request()->isMethod('put')) {
            return [
                'nombre'          => 'required|string|max:255',
                'tipo_usuario_id' => 'required|exists:tipo_usuarios,id',
                'estado'          => 'nullable|boolean',
                'registrado_por'  => 'nullable|integer',
            ];
        }

        return [];
    }

    public function messages(): array
    {
        return [
            'nombre.required'          => 'El nombre es obligatorio.',
            'nombre.max'               => 'El nombre no puede superar 255 caracteres.',
            'tipo_usuario_id.required' => 'Debe seleccionar un tipo de usuario.',
            'tipo_usuario_id.exists'   => 'El tipo de usuario seleccionado no existe.',
        ];
    }
}
