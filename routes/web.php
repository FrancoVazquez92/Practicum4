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
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\HistorialMedicoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmergenciaController;
use App\Http\Controllers\TriajeController;


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

Route::redirect('/', '/home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/citasmedicas/seleccionar-paciente', [CitaMedicaController::class, 'seleccionarPaciente'])
    ->name('citasmedicas.seleccionarPaciente')
    ->middleware('auth');

Route::get('/historial/seleccionar-paciente', [HistorialMedicoController::class, 'seleccionarPacienteMedico'])
    ->name('historial.seleccionarPacienteMedico')
    ->middleware('auth');

Route::get('/agendas/seleccionar-medico', [AgendaController::class, 'seleccionarMedico'])
    ->name('agendas.seleccionarMedico')
    ->middleware('auth');

Route::resource('triajes', TriajeController::class);
Route::resource('emergencias', EmergenciaController::class);
Route::resource('pacientes', PacienteController::class);
Route::resource('medicos', MedicoController::class);
Route::resource('atencionmedicas', AtencionMedicaController::class);
Route::resource('secretarias', SecretariaController::class);
Route::resource('rols', RolController::class);
Route::resource('administradores', AdministradorController::class)->parameters(['administradores' => 'administrador']);
Route::resource('gerencias', GerenciaController::class);
Route::resource('agendas', AgendaController::class);
Route::resource('citasmedicas', CitaMedicaController::class);
//Route::resource('emergencias', EmergenciaController::class);

// Agenda específica de un médico
Route::get('/medicos/{medico}/agendas', [AgendaController::class, 'index'])->name('agendas.index');
Route::get('/medicos/{medico}/agendas/create', [AgendaController::class, 'create'])->name('agendas.create');
Route::post('/medicos/{medico}/agendas', [AgendaController::class, 'store'])->name('agendas.store');

// Eliminar agenda (no necesita médico ID porque ya está en la agenda)
Route::delete('/agendas/{agenda}', [AgendaController::class, 'destroy'])->name('agendas.destroy');

Route::get('/pacientes/{paciente}/citasmedicas', [CitaMedicaController::class, 'index'])->name('citasmedicas.index');
Route::get('/pacientes/{paciente}/citasmedicas/create', [CitaMedicaController::class, 'create'])->name('citasmedicas.create');
Route::post('/pacientes/{paciente}/citasmedicas', [CitaMedicaController::class, 'store'])->name('citasmedicas.store');

Route::get('/medicos/{medico}/citas-asignadas', [CitaMedicaController::class, 'citasDelMedico'])->name('citasmedicas.medico');

// Para obtener médicos por especialidad (AJAX)
Route::get('/medicos/por-especialidad/{especialidad}', [MedicoController::class, 'porEspecialidad']);
Route::get('/agenda/fechas-disponibles/{medico}', [AgendaController::class, 'fechasDisponibles']);
Route::get('/agenda/horarios-disponibles/{medicoId}/{fecha}', [AgendaController::class, 'horariosDisponibles']);

Route::get('/notificaciones/marcar/{id}', [NotificacionController::class, 'marcarComoLeida'])->name('notificaciones.marcar');

Route::get('/citasmedicas/{id}/detalles', [CitaMedicaController::class, 'detalles']);

Route::get('/historial/{pacienteId}', [HistorialMedicoController::class, 'historialPaciente'])->name('historial.index');


Route::get('/dashboard/datos', [DashboardController::class, 'datos'])->name('dashboard.datos');

Route::post('/triaje/calcular', [TriajeController::class, 'calcular'])->name('triaje.calcular');
