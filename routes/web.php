<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route Hooks - Do not delete//
	Route::view('cal_cuentas', 'livewire.cuentas.index')->middleware('auth');
	Route::view('cal_tipocuentas', 'livewire.tipocuentas.index')->middleware('auth');
	Route::view('personas', 'livewire.personas.index')->middleware('auth');
	Route::view('bancos', 'livewire.bancos.index')->middleware('auth');
	Route::view('empresas', 'livewire.empresas.index')->middleware('auth');