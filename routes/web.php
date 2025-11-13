<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormController;

Route::get('/', function () {
    return view('inicio');
})->name('index');

Route::resource('formulario', FormController::class); 
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
