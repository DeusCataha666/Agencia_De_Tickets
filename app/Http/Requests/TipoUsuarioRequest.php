<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if (request()->isMethod('post')) {
            return [
                'nombre_tipo'    => 'required|string|max:255|unique:tipo_usuarios,nombre_tipo',
                'estado'         => 'nullable|boolean',
                'registrado_por' => 'nullable|integer',
            ];
        } elseif (request()->isMethod('put')) {
            return [
                'nombre_tipo'    => 'required|string|max:255|unique:tipo_usuarios,nombre_tipo,' . $this->route('tipousuario'),
                'estado'         => 'nullable|boolean',
                'registrado_por' => 'nullable|integer',
            ];
        }

        return [];
    }

    public function messages(): array
    {
        return [
            'nombre_tipo.required' => 'El nombre del tipo es obligatorio.',
            'nombre_tipo.unique'   => 'Ya existe un tipo de usuario con ese nombre.',
            'nombre_tipo.max'      => 'El nombre no puede superar 255 caracteres.',
        ];
    }
}
