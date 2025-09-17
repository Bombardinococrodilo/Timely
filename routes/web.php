<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EspaciosController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\AsignaturasController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/contacto', function () { 
    return view('contactos.index');
});
Route::get('/prueba', function () {
    return 'Hola, esta es una ruta de prueba en TIMELY';
});
Route::resource('espacios', EspaciosController::class);
Route::resource('profesores', ProfesorController::class);
Route::resource('asignaturas', AsignaturasController::class);