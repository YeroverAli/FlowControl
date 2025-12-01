<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

// Ruta principal ('/') que carga la vista "inicio"
Route::get('/', function () {
    return view('inicio');
})->name('index');

// Ruta tipo "resource" que genera automáticamente todas las rutas CRUD
// para el controlador FormController (index, create, store, show, edit, update, destroy)
Route::resource('formulario', FormController::class); 

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/users/create', [UserController::class, 'create']
   )->name('admin.users.create');
});
