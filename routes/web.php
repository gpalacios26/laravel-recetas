<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\PerfilController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [InicioController::class, 'index'])->name('inicio.index');

Route::get('/categorias/{id}', [CategoriaController::class, 'show'])->name('categorias.show');

Route::get('/recetas', [RecetaController::class, 'index'])->name('recetas.index');
Route::get('/recetas/create', [RecetaController::class, 'create'])->name('recetas.create');
Route::post('/recetas', [RecetaController::class, 'store'])->name('recetas.store');
Route::get('/recetas/{id}', [RecetaController::class, 'show'])->name('recetas.show');
Route::get('/recetas/{id}/edit', [RecetaController::class, 'edit'])->name('recetas.edit');
Route::put('/recetas/{id}', [RecetaController::class, 'update'])->name('recetas.update');
Route::delete('/recetas/{id}', [RecetaController::class, 'destroy'])->name('recetas.destroy');

Route::get('/search', [RecetaController::class, 'search'])->name('recetas.search');

Route::get('/perfiles/{perfil}', [PerfilController::class, 'show'])->name('perfiles.show');
Route::get('/perfiles/{perfil}/edit', [PerfilController::class, 'edit'])->name('perfiles.edit');
Route::put('/perfiles/{perfil}', [PerfilController::class, 'update'])->name('perfiles.update');

Auth::routes();
