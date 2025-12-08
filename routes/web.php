<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\AsignaturasController; 
use App\Http\Controllers\EspaciosController;   
use App\Http\Controllers\HorarioController;

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
});


require __DIR__.'/auth.php';