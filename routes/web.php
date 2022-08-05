<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\RequisitosController;
use App\Http\Controllers\Tipo_descuentoController;
use App\Http\Controllers\tipo_pagoController;
use App\Http\Controllers\TiposEstudiosController;
use App\Models\Estudiante;
use App\Models\Tipo_pago;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home1');
//Auth::routes();

//Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

//Usuario
Route::group(['prefix' => 'usuario'], function () {
	Route::get('/index', [UsuarioController::class, 'index'])->name('usuario.index');
	Route::get('/create', [UsuarioController::class, 'create'])->name('usuario.create');
	Route::post('/', [UsuarioController::class, 'store'])->name('usuario.store');
	Route::get('/edit/{usuario}', [UsuarioController::class, 'edit'])->name('usuario.edit');
	Route::put('/{usuario}', [UsuarioController::class, 'update'])->name('usuario.update');
	Route::delete('/{usuario}', [UsuarioController::class, 'destroy'])->name('usuario.delete');
});

/*/Documento
Route::group(['prefix' => 'documento'], function () {
	Route::get('/index', [\App\Http\Controllers\DocumentoController::class, 'index'])->name('documento.index');
	Route::get('/create', [\App\Http\Controllers\DocumentoController::class, 'create'])->name('documento.create');
});*/

//Area
Route::group(['prefix' => 'area'], function () {
	Route::get('/index', [AreaController::class, 'index'])->name('area.index');
	Route::get('/create', [AreaController::class, 'create'])->name('area.create');
	Route::post('/', [AreaController::class, 'store'])->name('area.store');
	Route::get('/edit/{area}', [AreaController::class, 'edit'])->name('area.edit');
	Route::put('/{area}', [AreaController::class, 'update'])->name('area.update');
	Route::delete('/{area}', [AreaController::class, 'destroy'])->name('area.delete');
});

//Cargo
Route::group(['prefix' => 'cargo'], function () {
	Route::get('/index', [CargoController::class, 'index'])->name('cargo.index');
	Route::get('/create', [CargoController::class, 'create'])->name('cargo.create');
	Route::post('/', [CargoController::class, 'store'])->name('cargo.store');
	Route::get('/edit/{cargo}', [CargoController::class, 'edit'])->name('cargo.edit');
	Route::put('/{cargo}', [CargoController::class, 'update'])->name('cargo.update');
	Route::delete('/{cargo}', [CargoController::class, 'destroy'])->name('cargo.delete');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

//Modulos
Route::group(['prefix' => 'modulo'], function () {
	Route::get('/index', [ModuloController::class, 'index'])->name('modulo.index');
	Route::get('/create', [ModuloController::class, 'create'])->name('modulo.create');
	Route::post('/store', [ModuloController::class, 'store'])->name('modulo.store');
	Route::get('/edit/{modulo}', [ModuloController::class, 'edit'])->name('modulo.edit');
	Route::put('/update/{modulo}', [ModuloController::class, 'update'])->name('modulo.update');
	Route::delete('/delete/{modulo}', [ModuloController::class, 'destroy'])->name('modulo.delete');
});

// Requisitos
Route::group(['prefix' => 'requisito', 'middleware' => 'auth'], function () {
	Route::get('/index', [RequisitosController::class, 'index'])->name('requisito.index');
	Route::get('/create', [RequisitosController::class, 'create'])->name('requisito.create');
	Route::post('/store', [RequisitosController::class, 'store'])->name('requisito.store');
	Route::get('/edit/{requisito}', [RequisitosController::class, 'edit'])->name('requisito.edit');
	Route::put('/update/{requisito}', [RequisitosController::class, 'update'])->name('requisito.update');
	Route::delete('/delete/{requisito}', [RequisitosController::class, 'destroy'])->name('requisito.delete');
});

// Estudiantes
Route::group(['prefix' => 'estudiante', 'middleware' => 'auth'], function () {
	Route::get('/index', [EstudianteController::class, 'index'])->name('estudiante.index');
	Route::get('/create', [EstudianteController::class, 'create'])->name('estudiante.create');
	Route::get('/show/{estudiante}', [EstudianteController::class, 'show'])->name('estudiante.show');
	Route::post('/store', [EstudianteController::class, 'store'])->name('estudiante.store');
	Route::get('/edit/{estudiante}', [EstudianteController::class, 'edit'])->name('estudiante.edit');
	Route::put('/update/{estudiante}', [EstudianteController::class, 'update'])->name('estudiante.update');
	Route::delete('/delete/{estudiante}', [EstudianteController::class, 'destroy'])->name('estudiante.delete');
});


//Tipo Descuento
Route::group(['prefix'=>'Tipo_Descuento'],function(){
	Route::get('/index',[Tipo_descuentoController::class,'index'])->name('descuento.index');
	Route::get('/create',[Tipo_descuentoController::class,'create'])->name('descuento.create');
});

//Tipo Pago
Route::group(['prefix'=>'Tipo_Pago'],function(){
	Route::get('/index',[tipo_pagoController::class,'index'])->name('tipo_pago.index');
	Route::get('/create',[tipo_pagoController::class,'create'])->name('tipo_pago.create');

// Programas
Route::group(['prefix' => 'programa', 'middleware' => 'auth'], function () {
	Route::get('/index', [ProgramaController::class, 'index'])->name('programa.index');
	Route::get('/create', [ProgramaController::class, 'create'])->name('programa.create');
	Route::get('/show/modulo/{programa}/{modulo}', [ProgramaController::class, 'modulo'])->name('programa.modulo');
	Route::get('/show/{programa}', [ProgramaController::class, 'show'])->name('programa.show');
	Route::get('/edit/{programa}', [ProgramaController::class, 'edit'])->name('programa.edit');
	Route::delete('/delete/{programa}', [ProgramaController::class, 'destroy'])->name('programa.delete');

});
