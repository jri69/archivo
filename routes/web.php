<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\HomeController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

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
Route::group(['prefix'=>'usuario'],function(){
	Route::get('/index',[\App\Http\Controllers\UsuarioController::class,'index'])->name('usuario.index');
	Route::get('/create',[\App\Http\Controllers\UsuarioController::class,'create'])->name('usuario.create');
	Route::get('/edit',[\App\Http\Controllers\UsuarioController::class,'edit'])->name('usuario.edit');
});

//Documento
Route::group(['prefix'=>'documento'],function(){
	Route::get('/index',[\App\Http\Controllers\DocumentoController::class,'index'])->name('documento.index');
	Route::get('/create',[\App\Http\Controllers\DocumentoController::class,'create'])->name('documento.create');
});

//Area
Route::group(['prefix'=>'area'],function(){
	Route::get('/index',[AreaController::class,'index'])->name('area.index');
	Route::get('/create',[AreaController::class,'create'])->name('area.create');
	Route::post('/',[AreaController::class,'store'])->name('area.store');
	Route::get('/edit/{area}',[AreaController::class,'edit'])->name('area.edit');
	Route::put('/{area}',[AreaController::class,'update'])->name('area.update');
	Route::delete('/{area}',[AreaController::class,'destroy'])->name('area.delete');
});

//Cargo
Route::group(['prefix'=>'cargo'],function(){
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



