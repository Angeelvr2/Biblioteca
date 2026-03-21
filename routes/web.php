<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\LibrosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PrestamosController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

    #agrupar rutas con Auth
Route::middleware('auth')->group(function() {
    Route::get('/home',[HomeController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create', [CategoriasController::class, 'create'])->name('categorias.create');
    Route::post('/categorias/store', [CategoriasController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{id}/edit', [CategoriasController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{id}', [CategoriasController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{id}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');

    Route::get('/libros/create', [LibrosController::class, 'create'])->name('libros.create');
    Route::post('/libros/store', [LibrosController::class, 'store'])->name('libros.store');
    Route::get('/libros/{id}/edit', [LibrosController::class, 'edit'])->name('libros.edit');
    Route::put('/libros/{id}', [LibrosController::class, 'update'])->name('libro.update');
    Route::delete('/libros/{id}', [LibrosController::class, 'destroy'])->name('libros.destroy');
});

Route::middleware(['auth', 'user_type:admin'])->group(function() {
    Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create', [CategoriasController::class, 'create'])->name('categorias.create');
    Route::post('/categorias/store', [CategoriasController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{id}/edit', [CategoriasController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{id}', [CategoriasController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{id}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');

    Route::get('/libros/create', [LibrosController::class, 'create'])->name('libros.create');
    Route::post('/libros/store', [LibrosController::class, 'store'])->name('libros.store');
    Route::get('/libros/{id}/edit', [LibrosController::class, 'edit'])->name('libros.edit');
    Route::put('/libros/{id}', [LibrosController::class, 'update'])->name('libro.update');
    Route::delete('/libros/{id}', [LibrosController::class, 'destroy'])->name('libros.destroy');

    Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{id}/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UsuariosController::class, 'update'])->name('usuarios.update');
    Route::get('/usuarios/{id}/delete', [UsuariosController::class, 'delete_confirm'])->name('usuarios.delete_confirm');
    Route::delete('/usuarios/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');

    Route::get('/prestamos', [PrestamosController::class, 'index'])->name('prestamos.index');
    Route::get('/prestamos/create', [PrestamosController::class, 'create'])->name('prestamos.create');
    Route::post('/prestamos/buscar_usuario', [PrestamosController::class, 'buscar_usuario'])->name('prestamos.buscar_usuario');
    Route::post('/prestamos/select_libro', [PrestamosController::class, 'select_libro'])->name('prestamos.select_libro');
    Route::post('/prestamos/store', [PrestamosController::class, 'store'])->name('prestamos.store');
    Route::get('/prestamos/{id}/entregar', [PrestamosController::class, 'entregar'])->name('prestamos.entregar');
});

Route::middleware(['auth', 'user_type:user'])->group(function() {
    
});
