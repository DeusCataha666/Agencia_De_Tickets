<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\TipoUsuario;
use App\Http\Requests\TipoUsuarioRequest;

class TipoUsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoUsuarios = TipoUsuario::all();
        return view('tipousuarios.index', compact('tipoUsuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipousuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TipoUsuarioRequest $request)
    {
        TipoUsuario::create($request->validated());
        return redirect()->route('tipousuarios.index')->with('successMsg', 'El registro se guardó exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tipoUsuario = TipoUsuario::findOrFail($id);
        return view('tipousuarios.show', compact('tipoUsuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tipoUsuario = TipoUsuario::findOrFail($id);
        return view('tipousuarios.edit', compact('tipoUsuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TipoUsuarioRequest $request, string $id)
    {
        $tipoUsuario = TipoUsuario::findOrFail($id);
        $tipoUsuario->update($request->validated());
        return redirect()->route('tipousuarios.index')->with('successMsg', 'El tipo de usuario se actualizó exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * Si el tipo está INACTIVO: desasigna los tickets de sus usuarios,
     * luego elimina los usuarios (cascade elimina comentarios) y por último
     * elimina el tipo — todo en una transacción.
     *
     * Si el tipo está ACTIVO: bloquea con mensaje claro.
     */
    public function destroy(string $id)
    {
        $tipoUsuario = TipoUsuario::withCount('usuarios')->findOrFail($id);

        // Tipo activo → no permitir
        if ($tipoUsuario->estado) {
            return redirect()
                ->route('tipousuarios.index')
                ->withErrors("No se puede eliminar el tipo \"{$tipoUsuario->nombre_tipo}\" porque está activo. Desactívalo primero.");
        }

        // Tipo inactivo → eliminar en cascada de forma controlada
        try {
            \DB::transaction(function () use ($tipoUsuario) {

                // 1. Desasignar tickets que apuntan a usuarios de este tipo
                $usuarioIds = $tipoUsuario->usuarios()->pluck('id');

                if ($usuarioIds->isNotEmpty()) {
                    \DB::table('tickets')
                        ->whereIn('usuario_asignado_id', $usuarioIds)
                        ->update(['usuario_asignado_id' => null]);

                    // 2. Eliminar usuarios (cascade borra sus comentarios)
                    $tipoUsuario->usuarios()->delete();
                }

                // 3. Eliminar el tipo
                $tipoUsuario->delete();
            });

            return redirect()
                ->route('tipousuarios.index')
                ->with('successMsg', "El tipo \"{$tipoUsuario->nombre_tipo}\" y sus usuarios asociados fueron eliminados correctamente.");

        } catch (Exception $e) {
            Log::error('Error al eliminar tipo de usuario #' . $tipoUsuario->id . ': ' . $e->getMessage());
            return redirect()
                ->route('tipousuarios.index')
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
