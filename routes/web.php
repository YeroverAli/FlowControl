<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormController;

Route::get('/', function () {
    return view('inicio');
})->name('index');

Route::resource('formulario', FormController::class);