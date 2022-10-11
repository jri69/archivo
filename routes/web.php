<?php

use App\Http\Controllers\ActivoFijoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\Cartas\ReporteController as CartasReporteController;
use App\Http\Controllers\ContratacionesController;
use App\Http\Controllers\DocentesController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\Pago_EstudianteController;
use App\Http\Controllers\Pago_ServicioController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PartidaController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\QuarterPartidaController;
use App\Http\Controllers\RecepcionController;
use App\Http\Controllers\RequisitosController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\SubPartidaController;
use App\Http\Controllers\SueldosController;
use App\Http\Controllers\ThirdPartidaController;
use App\Http\Controllers\Tipo_descuentoController;
use App\Http\Controllers\tipo_pagoController;
use App\Http\Controllers\UnidadOrganizacionalController;



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
    Route::delete('/delete/documento/{documento}', [EstudianteController::class, 'deleteFile'])->name('estudiante.deleteFile');
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
    Route::get('/edit/{estudiante}', [Pago_EstudianteController::class, 'edit'])->name('pago_estudiante.edit');
    Route::post('/store', [Pago_EstudianteController::class, 'store'])->name('pago_estudiante.store');
    Route::get('/show/{estudiante}', [Pago_EstudianteController::class, 'show'])->name('pago_estudiante.show');
    Route::put('/update/{estudiante}', [Pago_EstudianteController::class, 'update'])->name('pago_estudiante.update');
});

//Pago
Route::group(['prefix' => 'pago'], function () {
    Route::get('/index', [PagoController::class, 'index'])->name('pago.index');
    Route::get('/create/{id}', [PagoController::class, 'create'])->name('pago.create');
    Route::get('/edit/{pago}', [PagoController::class, 'edit'])->name('pago.edit');
    Route::post('/store/{id}', [PagoController::class, 'store'])->name('pago.store');
    Route::put('update/{pago}', [PagoController::class, 'update'])->name('pago.update');
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
Route::get('/pdf', [CartasReporteController::class, 'pdf'])->name('reporte.pdf');

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
    Route::put('/update/{movimiento}', [MovimientoController::class, 'update'])->name('movimiento.update');
    Route::get('/edit/{movimiento}/{recepcion}', [MovimientoController::class, 'edit'])->name('movimiento.edit');
    Route::get('/show/{movimiento}/{recepcion}', [MovimientoController::class, 'show'])->name('movimiento.show');
    Route::get('/confirm/{movimiento}/{recepcion}', [MovimientoController::class, 'confirmar'])->name('movimiento.confirmar');
});

// Documentos
Route::get('/documentos', [DocumentoController::class, 'index'])->name('documentos.index');

//Servicio
Route::group(['prefix' => 'servicio'], function () {
    Route::get('/index', [ServicioController::class, 'index'])->name('servicio.index');
    Route::get('/create', [ServicioController::class, 'create'])->name('servicio.create');
    Route::get('/edit/{servicio}', [ServicioController::class, 'edit'])->name('servicio.edit');
    Route::post('/store', [ServicioController::class, 'store'])->name('servicio.store');
    Route::put('/update/{servicio}', [ServicioController::class, 'update'])->name('servicio.update');
});
//Pago de Servicios
Route::group(['prefix' => 'pago_servicio'], function () {
    Route::get('/index', [Pago_ServicioController::class, 'index'])->name('pago_servicio.index');
    Route::get('/create', [Pago_ServicioController::class, 'create'])->name('pago_servicio.create');
    Route::get('/edit/{pago}', [Pago_ServicioController::class, 'edit'])->name('pago_servicio.edit');
    Route::post('/store', [Pago_ServicioController::class, 'store'])->name('pago_servicio.store');
    Route::put('/update/{pago}', [Pago_ServicioController::class, 'update'])->name('pago_servicio.update');
});

//Partida
Route::group(['prefix' => 'partida'], function () {
    Route::get('/index', [PartidaController::class, 'index'])->name('partida.index');
    Route::get('/create', [PartidaController::class, 'create'])->name('partida.create');
    Route::get('/edit/{partida}', [PartidaController::class, 'edit'])->name('partida.edit');
    Route::post('/store', [PartidaController::class, 'store'])->name('partida.store');
    Route::put('/update/{partida}', [PartidaController::class, 'update'])->name('partida.update');
});

//Sub Partidas
Route::group(['prefix' => 'subpartida'], function () {
    Route::get('/index', [SubPartidaController::class, 'index'])->name('subpartida.index');
    Route::get('/create', [SubPartidaController::class, 'create'])->name('subpartida.create');
    Route::get('/edit/{partida}', [SubPartidaController::class, 'edit'])->name('subpartida.edit');
    Route::post('/store', [SubPartidaController::class, 'store'])->name('subpartida.store');
    Route::put('/update/{partida}', [SubPartidaController::class, 'update'])->name('subpartida.update');
});

//Presupuesto
Route::group(['prefix' => 'presupuesto'], function () {
    Route::get('/index', [PresupuestoController::class, 'index'])->name('presupuesto.index');
    Route::get('/create', [PresupuestoController::class, 'create'])->name('presupuesto.create');
    Route::get('/edit/{presupuesto}', [PresupuestoController::class, 'edit'])->name('presupuesto.edit');
    Route::post('/store', [PresupuestoController::class, 'store'])->name('presupuesto.store');
    Route::put('/update/{presupuesto}', [PresupuestoController::class, 'update'])->name('presupuesto.update');
});

// Contrataciones
Route::group(['prefix' => 'contrataciones'], function () {
    Route::get('/', [ContratacionesController::class, 'index'])->name('contrataciones.index');
    Route::get('/create', [ContratacionesController::class, 'create'])->name('contrataciones.create');
    Route::post('/store', [ContratacionesController::class, 'store'])->name('contrataciones.store');
    Route::get('/edit/{contrataciones}', [ContratacionesController::class, 'edit'])->name('contrataciones.edit');
    Route::get('/show/{contrataciones}', [ContratacionesController::class, 'show'])->name('contrataciones.show');
    Route::put('/update/{contrataciones}', [ContratacionesController::class, 'update'])->name('contrataciones.update');
    Route::delete('/delete/{contrataciones}', [ContratacionesController::class, 'destroy'])->name('contrataciones.delete');
});

// Pagos sueldos
Route::group(['prefix' => 'sueldos'], function () {
    Route::get('/', [SueldosController::class, 'index'])->name('sueldos.index');
    Route::get('/create', [SueldosController::class, 'create'])->name('sueldos.create');
    Route::delete('/delete/{sueldos}', [SueldosController::class, 'destroy'])->name('sueldos.delete');
});

// Docentes
Route::group(['prefix' => 'docentes'], function () {
    Route::get('/', [DocentesController::class, 'index'])->name('docentes.index');
    Route::get('/create', [DocentesController::class, 'create'])->name('docentes.create');
    Route::post('/store', [DocentesController::class, 'store'])->name('docentes.store');
    Route::get('/edit/{docentes}', [DocentesController::class, 'edit'])->name('docentes.edit');
    Route::get('/show/{docentes}', [DocentesController::class, 'show'])->name('docentes.show');
    Route::put('/update/{docentes}', [DocentesController::class, 'update'])->name('docentes.update');
    Route::delete('/delete/{docentes}', [DocentesController::class, 'destroy'])->name('docentes.delete');
});

//Third Partida
Route::group(['prefix' => 'thirdpartida'], function () {
    Route::get('/index', [ThirdPartidaController::class, 'index'])->name('t_partida.index');
    Route::get('/create', [ThirdPartidaController::class, 'create'])->name('t_partida.create');
    Route::get('/edit/{partida}', [ThirdPartidaController::class, 'edit'])->name('t_partida.edit');
    Route::post('/store', [ThirdPartidaController::class, 'store'])->name('t_partida.store');
    Route::put('/update/{partida}', [ThirdPartidaController::class, 'update'])->name('t_partida.update');
});

//Quarter Partida
Route::group(['prefix' => 'quartecpartida'], function () {
    Route::get('/index', [QuarterPartidaController::class, 'index'])->name('c_partida.index');
    Route::get('/create', [QuarterPartidaController::class, 'create'])->name('c_partida.create');
    Route::get('/edit/{partida}', [QuarterPartidaController::class, 'edit'])->name('c_partida.edit');
    Route::post('/store', [QuarterPartidaController::class, 'store'])->name('c_partida.store');
    Route::put('/update/{partida}', [QuarterPartidaController::class, 'update'])->name('c_partida.update');
});
