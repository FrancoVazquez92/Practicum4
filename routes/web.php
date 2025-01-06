<?php

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

Route::resource('pacientes', Controller::class);
Route::resource('citamedica', Controller::class);
Route::resource('administrador', Controller::class);
Route::resource('sistemafacturacion', Controller::class);
Route::resource('historialmedico', Controller::class);
Route::resource('medico', Controller::class);
Route::resource('agenda', Controller::class);
Route::resource('reporte', Controller::class);
Route::resource('gerencia', Controller::class);