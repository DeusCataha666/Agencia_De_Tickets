<?php

use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\TipoUsuariosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ReporteController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('welcome');
});

Route::get('/about', function () {
    return 'acerca de nosotros';
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Rutas de Perfil
    Route::put('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/photo', [App\Http\Controllers\ProfileController::class, 'updatePhoto'])->name('profile.photo');

    Route::resource('clientes', ClientesController::class);
    Route::get('clientes/{id}/view-pdf', [ClientesController::class, 'viewPdf'])->name('clientes.viewPdf');
    Route::get('clientes/{id}/export-pdf', [ClientesController::class, 'exportPdf'])->name('clientes.exportPdf');
    Route::get('clientes/excel/export', [ReporteController::class, 'exportClientes'])->name('reportes.excel.clientes');
    Route::get('cambioestadocliente', [ClientesController::class, 'cambioestadocliente'])->name('cambioestadocliente');

    Route::resource('tickets', TicketsController::class);
    Route::get('cambioestadoticket', [TicketsController::class, 'cambioestadoticket'])->name('cambioestadoticket');
    Route::get('tickets/{id}/imprimir', [TicketsController::class, 'imprimir'])->name('tickets.imprimir');
    Route::get('tickets/{id}/view-pdf', [TicketsController::class, 'viewPdf'])->name('tickets.viewPdf');
    Route::get('tickets/{id}/export-pdf', [TicketsController::class, 'exportPdf'])->name('tickets.exportPdf');
    Route::get('reporte-excel/{id}', [ReporteController::class, 'exportPorId'])->name('reportes.excel.id');
    Route::get('reporte-excel', [ReporteController::class, 'exportGeneral'])->name('reportes.excel.general');

    Route::resource('comentarios', ComentariosController::class);
    Route::get('comentarios/{id}/view-pdf', [ComentariosController::class, 'viewPdf'])->name('comentarios.viewPdf');
    Route::get('comentarios/{id}/export-pdf', [ComentariosController::class, 'exportPdf'])->name('comentarios.exportPdf');
    Route::get('comentarios/excel/export', [ReporteController::class, 'exportComentarios'])->name('reportes.excel.comentarios');
    Route::get('cambioestadocomentario', [ComentariosController::class, 'cambioestadocomentario'])->name('cambioestadocomentario');

    Route::resource('tipousuarios', TipoUsuariosController::class);
    Route::get('cambioestadotipousuario', [TipoUsuariosController::class, 'cambioestadotipousuario'])->name('cambioestadotipousuario');

    Route::resource('usuarios', UsuariosController::class);
    Route::get('cambioestadousuario', [UsuariosController::class, 'cambioestadousuario'])->name('cambioestadousuario');
});



Auth::routes();

// Rutas para visualizar páginas de error (solo para desarrollo)
Route::get('/errors/403', function() {
    return view('errors.403');
})->name('error.403');

Route::get('/errors/404', function() {
    return view('errors.404');
})->name('error.404');

Route::get('/errors/500', function() {
    return view('errors.500');
})->name('error.500');

Route::get('/errors/419', function() {
    return view('errors.419');
})->name('error.419');

Route::get('/errors/503', function() {
    return view('errors.503');
})->name('error.503');