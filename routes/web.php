<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/contacto', function () { 
    return view('contactos.index');
});
Route::get('/prueba', function () {
    return 'Hola, esta es una ruta de prueba en TIMELY';
});

