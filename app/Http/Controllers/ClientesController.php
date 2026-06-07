<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Exception;
use App\Models\Cliente;
use App\Http\Requests\ClienteRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index',compact('clientes'));
    }

    public function viewPdf($id)
    {
        $cliente = Cliente::findOrFail($id);
        $pdf = Pdf::loadView('clientes.pdf-single', compact('cliente'))->setPaper('a4', 'portrait');
        return $pdf->stream('cliente-' . $cliente->id . '.pdf');
    }

    public function exportPdf($id = null)
    {
        if ($id === 'all' || $id === null) {
            $clientes = Cliente::all();
            $pdf = Pdf::loadView('clientes.pdf', compact('clientes'))->setPaper('a4', 'portrait');
            return $pdf->download('clientes.pdf');
        }

        $cliente = Cliente::findOrFail($id);
        $pdf = Pdf::loadView('clientes.pdf-single', compact('cliente'))->setPaper('a4', 'portrait');
        return $pdf->download('cliente-' . $cliente->id . '.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClienteRequest $request)
    {
        Cliente::create($request->validated());
        return redirect()->route('clientes.index')->with('successMsg', 'El registro se guardó exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::with('tickets')->findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClienteRequest $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->validated());
        return redirect()->route('clientes.index')->with('successMsg', 'El cliente se actualizó exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();
            return redirect()->route('clientes.index')->with('successMsg', 'El cliente se eliminó exitosamente');
        } catch (QueryException $e) {
            Log::error('Error al eliminar el cliente: ' . $e->getMessage());
            return redirect()->route('clientes.index')->withErrors('El cliente que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar el cliente: ' . $e->getMessage());
            return redirect()->route('clientes.index')->withErrors('Ocurrió un error inesperado al eliminar el cliente. Comuníquese con el Administrador');
        }
    }

    public function cambioestadocliente(Request $request)
    {
        $cliente = Cliente::find($request->id);

        if (!$cliente) {
            return response()->json(['success' => false, 'message' => 'Cliente no encontrado.'], 404);
        }

        $cliente->estado = (int) $request->estado;
        $cliente->save();

        return response()->json(['success' => true, 'estado' => $cliente->estado]);
    }
}
