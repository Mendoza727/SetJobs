<?php

use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacanteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');

Route::get('/dashboard',[VacanteController::class, 'index'])->middleware(['auth', 'rol.reclutador'])->name('dashboard');
Route::get('/vacante/create',[VacanteController::class, 'create'])->middleware(['auth'])->name('vacantes.create');
Route::get('/vacante/{vacante}/edit',[VacanteController::class, 'edit'])->middleware(['auth'])->name('vacantes.edit');
Route::get('/vacante/{vacante}',[VacanteController::class, 'show'])->name('vacantes.show');
Route::get('candidatos/{vacante}', [CandidatoController::class, 'index'])->name('candidato.index');
//notificacion
Route::get('/notificaciones', NotificacionController::class)->middleware(['auth', 'rol.reclutador'])->name('notificaciones');

Route::middleware('auth')->group(function () {
    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
