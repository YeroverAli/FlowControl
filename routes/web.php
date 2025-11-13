<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormController;

// Ruta principal ('/') que carga la vista "inicio"
Route::get('/', function () {
    return view('inicio');
})->name('index');

// Ruta tipo "resource" que genera automáticamente todas las rutas CRUD
// para el controlador FormController (index, create, store, show, edit, update, destroy)
Route::resource('formulario', FormController::class); 