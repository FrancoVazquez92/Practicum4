<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\GerenciaController;
use App\Http\Controllers\HistorialMedicoController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\SistemaFacturacionController;
use App\Models\Administrador;
use App\Models\CitaMedica;
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

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});*/
Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('pacientes', PacienteController::class);
Route::resource('citamedica', CitaMedicaController::class);
Route::resource('administrador', AdministradorController::class);
Route::resource('sistemafacturacion', SistemaFacturacionController::class);
Route::resource('historialmedico', HistorialMedicoController::class);
Route::resource('medicos', MedicoController::class);
Route::resource('agenda', AgendaController::class);
Route::resource('reporte', ReporteController::class);
Route::resource('gerencia', GerenciaController::class);