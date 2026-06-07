<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\Comentario;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalTickets       = Ticket::count();
        $ticketsActivos     = Ticket::where('estado', 1)->count();
        $totalClientes      = Cliente::count();
        $totalUsuarios      = Usuario::count();
        $totalComentarios   = Comentario::count();
        $ticketsSinAsignar  = Ticket::whereNull('usuario_asignado_id')->count();

        // Datos recientes para el dashboard
        $recentTickets = Ticket::with(['cliente', 'usuarioAsignado'])
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        $recentComments = Comentario::with(['ticket', 'usuario'])
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        // Estadísticas para gráficos
        $ticketsInactivos = $totalTickets - $ticketsActivos;
        
        $ticketsPorSector = Ticket::selectRaw('sector, count(*) as count')
            ->whereNotNull('sector')
            ->groupBy('sector')
            ->get();

        return view('home', compact(
            'totalTickets',
            'ticketsActivos',
            'totalClientes',
            'totalUsuarios',
            'totalComentarios',
            'ticketsSinAsignar',
            'recentTickets',
            'recentComments',
            'ticketsInactivos',
            'ticketsPorSector'
        ));
    }

}
