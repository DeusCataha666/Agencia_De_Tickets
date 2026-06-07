<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Exception;
use App\Models\Comentario;
use App\Models\Ticket;
use App\Models\Usuario;
use App\Http\Requests\ComentarioRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class ComentariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comentarios = Comentario::all();
        return view('comentarios.index', compact('comentarios'));
    }

    public function viewPdf($id)
    {
        $comentario = Comentario::with(['ticket', 'usuario'])->findOrFail($id);
        $pdf = Pdf::loadView('comentarios.pdf-single', compact('comentario'))->setPaper('a4', 'portrait');
        return $pdf->stream('comentario-' . $comentario->id . '.pdf');
    }

    public function exportPdf($id = null)
    {
        if ($id === 'all' || $id === null) {
            $comentarios = Comentario::with(['ticket', 'usuario'])->get();
            $pdf = Pdf::loadView('comentarios.pdf', compact('comentarios'))->setPaper('a4', 'portrait');
            return $pdf->download('comentarios.pdf');
        }

        $comentario = Comentario::with(['ticket', 'usuario'])->findOrFail($id);
        $pdf = Pdf::loadView('comentarios.pdf-single', compact('comentario'))->setPaper('a4', 'portrait');
        return $pdf->download('comentario-' . $comentario->id . '.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tickets = Ticket::where('estado', 1)->get();
        $usuarios = Usuario::where('estado', 1)->get();
        return view('comentarios.create', compact('tickets', 'usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComentarioRequest $request)
    {
        $validated = $request->validated();
        
        // Procesar imagen si se proporciona
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $path = $file->store('comentarios', 'public');
            $validated['imagen'] = $path;
        }
        
        Comentario::create($validated);
        return redirect()->route('comentarios.index')->with('successMsg', 'El registro se guardó exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comentario = Comentario::with(['ticket', 'usuario'])->findOrFail($id);
        return view('comentarios.show', compact('comentario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $comentario = Comentario::findOrFail($id);
        $tickets = Ticket::where('estado', 1)->get();
        $usuarios = Usuario::where('estado', 1)->get();
        return view('comentarios.edit', compact('comentario', 'tickets', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComentarioRequest $request, string $id)
    {
        $comentario = Comentario::findOrFail($id);
        $validated = $request->validated();
        
        // Procesar imagen si se proporciona
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($comentario->imagen && \Storage::disk('public')->exists($comentario->imagen)) {
                \Storage::disk('public')->delete($comentario->imagen);
            }
            $file = $request->file('imagen');
            $path = $file->store('comentarios', 'public');
            $validated['imagen'] = $path;
        }
        
        $comentario->update($validated);
        return redirect()->route('comentarios.index')->with('successMsg', 'El comentario se actualizó exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $comentario = Comentario::findOrFail($id);
            $comentario->delete();
            return redirect()->route('comentarios.index')->with('successMsg', 'El comentario se eliminó exitosamente');
        } catch (QueryException $e) {
            Log::error('Error al eliminar el comentario: ' . $e->getMessage());
            return redirect()->route('comentarios.index')->withErrors('El comentario que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar el comentario: ' . $e->getMessage());
            return redirect()->route('comentarios.index')->withErrors('Ocurrió un error inesperado al eliminar el comentario. Comuníquese con el Administrador');
        }
    }

    public function cambioestadocomentario(Request $request)
    {
        $comentario = Comentario::find($request->id);

        if (!$comentario) {
            return response()->json(['success' => false, 'message' => 'Comentario no encontrado.'], 404);
        }

        $comentario->estado = (int) $request->estado;
        $comentario->save();

        return response()->json(['success' => true, 'estado' => $comentario->estado]);
    }
}
