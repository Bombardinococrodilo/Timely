<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\AsignaturasController; 
use App\Http\Controllers\EspaciosController;   
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\NotificacionController;

/*
|--------------------------------------------------------------------------
| Rutas Web
|--------------------------------------------------------------------------
*/


Route::get('/', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    
  
    Route::get('horarios/grilla', [HorarioController::class, 'grilla'])->name('horarios.grilla');
    Route::get('horarios/pdf', [HorarioController::class, 'descargarPDF'])->name('horarios.pdf');
    Route::resource('horarios', HorarioController::class);

    Route::resource('profesores', ProfesorController::class);
    Route::resource('cursos', CursoController::class);
    Route::resource('asignaturas', AsignaturasController::class); 
    Route::resource('espacios', EspaciosController::class);       

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
    Route::post('/notificaciones/enviar', [NotificacionController::class, 'enviarMasivo'])->name('notificaciones.enviar');
    Route::post('/enviar-horarios-masivo', [NotificacionController::class, 'enviarMasivoHorarios'])
    ->name('notificaciones.enviar.horarios');
});

require __DIR__.'/auth.php';

Route::get('/kiosco', [App\Http\Controllers\KioscoController::class, 'index'])->name('kiosco.index');
Route::get('/kiosco/descargar/{id}', [App\Http\Controllers\KioscoController::class, 'descargarPdf'])->name('kiosco.descargar');