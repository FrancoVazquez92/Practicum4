<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\CitaMedicaController;
use App\Http\Controllers\AtencionMedicaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\GerenciaController;

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


Route::get('/home', function () {
    return view('home');
})->name('home');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});

require __DIR__.'/auth.php';

Route::resource('pacientes', PacienteController::class);
Route::resource('medicos', MedicoController::class);
Route::resource('citasmedicas', CitaMedicaController::class);
Route::resource('atencionmedicas', AtencionMedicaController::class);
Route::resource('secretarias', SecretariaController::class);
Route::resource('rols', RolController::class);
Route::resource('administradores', AdministradorController::class)->parameters(['administradores' => 'administrador']);
Route::resource('gerencias', GerenciaController::class);


