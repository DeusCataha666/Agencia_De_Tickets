<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Exception;
use App\Models\Usuario;
use App\Models\TipoUsuario;
use App\Http\Requests\UsuarioRequest;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipoUsuarios = TipoUsuario::where('estado', 1)->get();
        return view('usuarios.create', compact('tipoUsuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsuarioRequest $request)
    {
        Usuario::create($request->validated());
        return redirect()->route('usuarios.index')->with('successMsg', 'El registro se guardó exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = Usuario::with('tipoUsuario')->findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        $tipoUsuarios = TipoUsuario::where('estado', 1)->get();
        return view('usuarios.edit', compact('usuario', 'tipoUsuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsuarioRequest $request, string $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->validated());
        return redirect()->route('usuarios.index')->with('successMsg', 'El usuario se actualizó exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            $usuario->delete();
            return redirect()->route('usuarios.index')->with('successMsg', 'El usuario se eliminó exitosamente');
        } catch (QueryException $e) {
            Log::error('Error al eliminar el usuario: ' . $e->getMessage());
            return redirect()->route('usuarios.index')->withErrors('El usuario que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar el usuario: ' . $e->getMessage());
            return redirect()->route('usuarios.index')->withErrors('Ocurrió un error inesperado al eliminar el usuario. Comuníquese con el Administrador');
        }
    }

    public function cambioestadousuario(Request $request)
    {
        $usuario = Usuario::find($request->id);

        if (!$usuario) {
            return response()->json(['success' => false, 'message' => 'Usuario no encontrado.'], 404);
        }

        $usuario->estado = (int) $request->estado;
        $usuario->save();

        return response()->json(['success' => true, 'estado' => $usuario->estado]);
    }
}
