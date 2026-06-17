<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if (request()->isMethod('post')) {
            return [
                'nombre'        => 'required|string|max:255|unique:clientes,nombre',
                'direccion'     => 'nullable|string|max:255',
                'telefono'      => 'nullable|string|max:20',
                'estado'        => 'nullable|boolean',
                'registrado_por'=> 'nullable|integer',
            ];
        } elseif (request()->isMethod('put')) {
            return [
                'nombre'        => 'required|string|max:255|unique:clientes,nombre,' . $this->route('cliente'),
                'direccion'     => 'nullable|string|max:255',
                'telefono'      => 'nullable|string|max:20',
                'estado'        => 'nullable|boolean',
                'registrado_por'=> 'nullable|integer',
            ];
        }

        return [];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.unique'   => 'Ya existe un cliente con ese nombre.',
            'nombre.max'      => 'El nombre no puede superar 255 caracteres.',
            'telefono.max'    => 'El teléfono no puede superar 20 caracteres.',
        ];
    }
}
