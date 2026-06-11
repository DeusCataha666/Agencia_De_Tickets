<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
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
     */
    public function destroy(string $id)
    {
        $tipoUsuario = TipoUsuario::withCount('usuarios')->findOrFail($id);

        try {
            $tipoUsuario->delete();
            return redirect()
                ->route('tipousuarios.index')
                ->with('successMsg', 'El tipo de usuario se eliminó exitosamente.');

        } catch (QueryException $e) {
            Log::error('Error al eliminar tipo de usuario #' . $id . ': ' . $e->getMessage());

            $cantidad = $tipoUsuario->usuarios_count;
            $msg = "No se puede eliminar el tipo \"{$tipoUsuario->nombre_tipo}\" porque tiene "
                 . "{$cantidad} usuario(s) asignado(s). "
                 . "Reasigna o elimina esos usuarios primero.";

            return redirect()
                ->route('tipousuarios.index')
                ->withErrors($msg);

        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar tipo de usuario #' . $id . ': ' . $e->getMessage());
            return redirect()
                ->route('tipousuarios.index')
                ->withErrors('Ocurrió un error inesperado. Intenta nuevamente.');
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
