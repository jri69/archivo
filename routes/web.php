<?php

use App\Http\Controllers\ActivoFijoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\Pago_EstudianteController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\RecepcionController;
use App\Http\Controllers\Reportes\ReporteController;
use App\Http\Controllers\RequisitosController;
use App\Http\Controllers\Tipo_descuentoController;
use App\Http\Controllers\tipo_pagoController;
use App\Http\Controllers\TiposEstudiosController;
use App\Http\Controllers\UnidadOrganizacionalController;
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

//Documento
Route::group(['prefix' => 'documento'], function () {
    Route::get('/index', [\App\Http\Controllers\DocumentoController::class, 'index'])->name('documento.index');
    Route::get('/create', [\App\Http\Controllers\DocumentoController::class, 'create'])->name('documento.create');
});

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
    Route::get('/show/notas/{estudiante}/{programa}', [EstudianteController::class, 'showNotas'])->name('estudiante.showNotas');
    Route::get('/inscribirse/{estudiante}', [EstudianteController::class, 'newprogram'])->name('estudiante.newprogram');
    Route::get('/show/{estudiante}', [EstudianteController::class, 'show'])->name('estudiante.show');
    Route::get('/edit/{estudiante}', [EstudianteController::class, 'edit'])->name('estudiante.edit');
    Route::put('/update/{estudiante}', [EstudianteController::class, 'update'])->name('estudiante.update');
    Route::post('/store', [EstudianteController::class, 'store'])->name('estudiante.store');
    Route::post('/inscribirse/store/{estudiante}', [EstudianteController::class, 'storenewprogram'])->name('estudiante.storenewprogram');
    Route::delete('/delete/{estudiante}', [EstudianteController::class, 'destroy'])->name('estudiante.delete');
});

//Tipo Descuento
Route::group(['prefix' => 'tipo_descuento'], function () {
    Route::get('/index', [Tipo_descuentoController::class, 'index'])->name('descuento.index');
    Route::get('/create', [Tipo_descuentoController::class, 'create'])->name('descuento.create');
    Route::post('/store', [Tipo_descuentoController::class, 'store'])->name('descuento.store');
    Route::get('/edit/{descuento}', [Tipo_descuentoController::class, 'edit'])->name('descuento.edit');
    Route::put('/update/{descuento}', [Tipo_descuentoController::class, 'update'])->name('descuento.update');
});

//Tipo Pago
Route::group(['prefix' => 'tipo_pago'], function () {
    Route::get('/index', [tipo_pagoController::class, 'index'])->name('tipo_pago.index');
    Route::get('/create', [tipo_pagoController::class, 'create'])->name('tipo_pago.create');
    Route::post('/store', [tipo_pagoController::class, 'store'])->name('tipo_pago.store');
    Route::get('/edit/{pago}', [tipo_pagoController::class, 'edit'])->name('tipo_pago.edit');
    Route::put('/update/{tipo_pago}', [tipo_pagoController::class, 'update'])->name('tipo_pago.update');
});

//Pago Estudiante
Route::group(['prefix' => 'Pago_Estudiante'], function () {
    Route::get('/index', [Pago_EstudianteController::class, 'index'])->name('pago_estudiante.index');
    Route::get('/create', [Pago_EstudianteController::class, 'create'])->name('pago_estudiante.create');
    Route::post('/store', [Pago_EstudianteController::class, 'store'])->name('pago_estudiante.store');
    Route::get('/show/{estudiante}', [Pago_EstudianteController::class, 'show'])->name('pago_estudiante.show');
});

//Pago
Route::group(['prefix' => 'pago'], function () {
    Route::get('/index', [PagoController::class, 'index'])->name('pago.index');
    Route::get('/create/{id}', [PagoController::class, 'create'])->name('pago.create');
    Route::post('/store/{id}', [PagoController::class, 'store'])->name('pago.store');
});

// Programas
Route::group(['prefix' => 'programa', 'middleware' => 'auth'], function () {
    Route::get('/index', [ProgramaController::class, 'index'])->name('programa.index');
    Route::get('/create', [ProgramaController::class, 'create'])->name('programa.create');
    Route::get('/show/modulo/init/{programa}/{modulo}', [ProgramaController::class, 'init'])->name('programa.init');
    Route::get('/show/modulo/{programa}/{modulo}', [ProgramaController::class, 'modulo'])->name('programa.modulo');
    Route::get('/show/modulo/notas/{programa}/{modulo}', [ProgramaController::class, 'notas'])->name('programa.notas');
    Route::get('/show/modulo/inscritos/{programa}/{modulo}', [ProgramaController::class, 'actInscritos'])->name('programa.inscritos');

    Route::get('/show/{programa}', [ProgramaController::class, 'show'])->name('programa.show');
    Route::get('/edit/{programa}', [ProgramaController::class, 'edit'])->name('programa.edit');
    Route::delete('/delete/{programa}', [ProgramaController::class, 'destroy'])->name('programa.delete');
});

// TIC'S
Route::group(['prefix' => 'tics'], function () {
    Route::get('/index', [InventarioController::class, 'index'])->name('inventario.index');
    Route::get('/create', [InventarioController::class, 'create'])->name('inventario.create');
    Route::post('/store', [InventarioController::class, 'store'])->name('inventario.store');
    Route::get('/edit/{inventario}', [InventarioController::class, 'edit'])->name('inventario.edit');
    Route::put('/update/{inventario}', [InventarioController::class, 'update'])->name('inventario.update');
    Route::delete('/delete/{inventario}', [InventarioController::class, 'destroy'])->name('inventario.delete');
});

// Activo Fijo
Route::group(['prefix' => 'activo_fijo'], function () {
    Route::get('/index', [ActivoFijoController::class, 'index'])->name('activo.index');
    Route::get('/create', [ActivoFijoController::class, 'create'])->name('activo.create');
    Route::post('/store', [ActivoFijoController::class, 'store'])->name('activo.store');
    Route::get('/edit/{activo}', [ActivoFijoController::class, 'edit'])->name('activo.edit');
    Route::put('/update/{activo}', [ActivoFijoController::class, 'update'])->name('activo.update');
    Route::delete('/delete/{activo}', [ActivoFijoController::class, 'destroy'])->name('activo.delete');
});

// Recursos humanos
Route::get('/pdf', [ReporteController::class, 'pdf'])->name('reporte.pdf');

// Unidad organizacional
Route::group(['prefix' => 'unidad_organizacional'], function () {
    Route::get('/index', [UnidadOrganizacionalController::class, 'index'])->name('unidad.index');
    Route::get('/create', [UnidadOrganizacionalController::class, 'create'])->name('unidad.create');
    Route::post('/store', [UnidadOrganizacionalController::class, 'store'])->name('unidad.store');
    Route::get('/edit/{unidad}', [UnidadOrganizacionalController::class, 'edit'])->name('unidad.edit');
    Route::put('/update/{unidad}', [UnidadOrganizacionalController::class, 'update'])->name('unidad.update');
    Route::delete('/delete/{unidad}', [UnidadOrganizacionalController::class, 'destroy'])->name('unidad.delete');
});

// recepcion de la documentacion
Route::group(['prefix' => 'recepcion'], function () {
    Route::get('/index', [RecepcionController::class, 'index'])->name('recepcion.index');       // list of all documents
    Route::get('/create', [RecepcionController::class, 'create'])->name('recepcion.create');    // create a new recepcion
    Route::post('/store', [RecepcionController::class, 'store'])->name('recepcion.store');  // store a new recepcion
    Route::get('/show/{recepcion}', [RecepcionController::class, 'show'])->name('recepcion.show');    // show a recepcion
    Route::get('/edit/{recepcion}', [RecepcionController::class, 'edit'])->name('recepcion.edit');    // edit a recepcion
    Route::put('/update/{recepcion}', [RecepcionController::class, 'update'])->name('recepcion.update');  // update a recepcion
    Route::delete('/delete/{recepcion}', [RecepcionController::class, 'destroy'])->name('recepcion.delete'); // delete a recepcion
});

// Movimiento de la documentacion
Route::group(['prefix' => 'movimiento'], function () {
    Route::get('/create/{id}', [MovimientoController::class, 'create'])->name('movimiento.create');
    Route::post('/store', [MovimientoController::class, 'store'])->name('movimiento.store');
    Route::delete('/delete/{movimiento}', [MovimientoController::class, 'destroy'])->name('movimiento.delete');
    Route::get('/show/{movimiento}', [MovimientoController::class, 'show'])->name('movimiento.show');
    Route::get('/edit/{movimiento}', [MovimientoController::class, 'edit'])->name('movimiento.edit');
    Route::put('/update/{movimiento}', [MovimientoController::class, 'update'])->name('movimiento.update');
});
