<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormController;

Route::get('/', function () {
    return view('inicio');
});

Route::get('/formulario/enviar', [FormController::class, 'create'])->name('formulario.create');
Route::post('/formulario/guardar', [FormController::class, 'store'])->name('formulario.store');