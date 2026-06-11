<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\TipoUsuario;
use App\Http\Requests\TipoUsuarioRequest;

class TipoUsuariosController extends Controller
{
    public function index()
    {
        $tipoUsuarios = TipoUsuario::all();
        return view('tipousuarios.index', compact('tipoUsuarios'));
    }

    public function create()
    {
        return view('tipousuarios.create');
    }

    /**
     * Valida manualmente para garantizar que en producción nunca
     * se lanza un 500 por nombre duplicado — siempre redirige con error visible.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_tipo' => 'required|string|max:255',
        ], [
            'nombre_tipo.required' => 'El nombre del tipo es obligatorio.',
            'nombre_tipo.max'      => 'El nombre no puede superar 255 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Verificar duplicado de forma explícita para dar mensaje claro
        $existe = TipoUsuario::whereRaw('LOWER(nombre_tipo) = ?', [strtolower($request->nombre_tipo)])->first();

        if ($existe) {
            $estado = $existe->estado ? 'activo' : 'inactivo';
            return redirect()->back()
                ->withErrors([
                    'nombre_tipo' => "Ya existe un tipo de usuario con el nombre \"{$existe->nombre_tipo}\" (actualmente {$estado}). No se permiten nombres duplicados.",
                ])
                ->withInput();
        }

        try {
            TipoUsuario::create([
                'nombre_tipo'    => $request->nombre_tipo,
                'estado'         => 1,
                'registrado_por' => $request->registrado_por ?? auth()->id(),
            ]);

            return redirect()->route('tipousuarios.index')
                ->with('successMsg', 'El tipo de usuario se registró exitosamente.');

        } catch (Exception $e) {
            Log::error('Error al crear tipo de usuario: ' . $e->getMessage());
            return redirect()->back()
                ->withErrors(['nombre_tipo' => 'Ocurrió un error al guardar. Intenta nuevamente.'])
                ->withInput();
        }
    }

    public function show(string $id)
    {
        $tipoUsuario = TipoUsuario::findOrFail($id);
        return view('tipousuarios.show', compact('tipoUsuario'));
    }

    public function edit(string $id)
    {
        $tipoUsuario = TipoUsuario::findOrFail($id);
        return view('tipousuarios.edit', compact('tipoUsuario'));
    }

    public function update(TipoUsuarioRequest $request, string $id)
    {
        $tipoUsuario = TipoUsuario::findOrFail($id);
        $tipoUsuario->update($request->validated());
        return redirect()->route('tipousuarios.index')
            ->with('successMsg', 'El tipo de usuario se actualizó exitosamente.');
    }

    /**
     * Activo → bloquear con mensaje.
     * Inactivo → desasignar tickets, borrar usuarios (cascade comentarios), borrar tipo.
     */
    public function destroy(string $id)
    {
        $tipoUsuario = TipoUsuario::withCount('usuarios')->findOrFail($id);

        if ($tipoUsuario->estado) {
            return redirect()->route('tipousuarios.index')
                ->withErrors("No se puede eliminar el tipo \"{$tipoUsuario->nombre_tipo}\" porque está activo. Desactívalo primero.");
        }

        try {
            \DB::transaction(function () use ($tipoUsuario) {
                $usuarioIds = $tipoUsuario->usuarios()->pluck('id');

                if ($usuarioIds->isNotEmpty()) {
                    \DB::table('tickets')
                        ->whereIn('usuario_asignado_id', $usuarioIds)
                        ->update(['usuario_asignado_id' => null]);

                    $tipoUsuario->usuarios()->delete();
                }

                $tipoUsuario->delete();
            });

            return redirect()->route('tipousuarios.index')
                ->with('successMsg', "El tipo \"{$tipoUsuario->nombre_tipo}\" y sus usuarios asociados fueron eliminados correctamente.");

        } catch (Exception $e) {
            Log::error('Error al eliminar tipo de usuario #' . $tipoUsuario->id . ': ' . $e->getMessage());
            return redirect()->route('tipousuarios.index')
                ->withErrors('Ocurrió un error inesperado al intentar eliminar. Intenta nuevamente.');
        }
    }

    public function cambioestadotipousuario(Request $request)
    {
        $tipoUsuario = TipoUsuario::find($request->id);

        if (!$tipoUsuario) {
            return response()->json(['success' => false, 'message' => 'Tipo de usuario no encontrado.'], 404);
        }

        $tipoUsuario->estado = (int) $request->estado;
        $tipoUsuario->save();

        return response()->json(['success' => true, 'estado' => $tipoUsuario->estado]);
    }
}
