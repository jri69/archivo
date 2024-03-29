<?php

use App\Http\Controllers\ActivoFijoController;
use App\Http\Controllers\AdministrativoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\CartaController;
use App\Http\Controllers\Cartas\ReporteController as CartasReporteController;
use App\Http\Controllers\CartaTitulacion;
use App\Http\Controllers\ContratacionController;
use App\Http\Controllers\ContratacionesController;
use App\Http\Controllers\DetalleFacturaController;
use App\Http\Controllers\DirectivoController;
use App\Http\Controllers\DocentesController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\FifthPartidaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\Pago_EstudianteController;
use App\Http\Controllers\Pago_ServicioController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PartidaController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\ProcesosController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\QuarterPartidaController;
use App\Http\Controllers\RecepcionController;
use App\Http\Controllers\RequisitosController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\SubPartidaController;
use App\Http\Controllers\SueldosController;
use App\Http\Controllers\ThirdPartidaController;
use App\Http\Controllers\TicController;
use App\Http\Controllers\Tipo_descuentoController;
use App\Http\Controllers\tipo_pagoController;
use App\Http\Controllers\UnidadOrganizacionalController;
use App\Http\Controllers\UniversidadController;

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

//Usuario
Route::group(['prefix' => 'calendario', 'middleware' => ['can:calendario.index', 'auth']], function () {
    Route::get('/', [CalendarioController::class, 'index'])->name('calendario.index');
    Route::get('/doctorados', [CalendarioController::class, 'doctorados'])->name('calendario.doctorado');
    Route::get('/maestrias', [CalendarioController::class, 'maestrias'])->name('calendario.maestria');
    Route::get('/diplomados', [CalendarioController::class, 'diplomados'])->name('calendario.diplomado');
    Route::get('/cursos', [CalendarioController::class, 'cursos'])->name('calendario.curso');
    Route::get('/especialidades', [CalendarioController::class, 'especialidades'])->name('calendario.especialidades');
    Route::get('/otros', [CalendarioController::class, 'otros'])->name('calendario.otros');
    Route::get('/inicio', [CalendarioController::class, 'inicio'])->name('calendario.inicio');
    Route::get('/finalizado', [CalendarioController::class, 'finalizado'])->name('calendario.finalizado');
    Route::get('/eventos', [CalendarioController::class, 'eventos'])->name('calendario.eventos');
});

//Usuario
Route::group(['prefix' => 'usuario', 'middleware' => ['can:usuario.index', 'auth']], function () {
    Route::get('/', [UsuarioController::class, 'index'])->name('usuario.index');
    Route::get('/create', [UsuarioController::class, 'create'])->name('usuario.create');
    Route::post('/', [UsuarioController::class, 'store'])->name('usuario.store');
    Route::get('/edit/{usuario}', [UsuarioController::class, 'edit'])->name('usuario.edit');
    Route::put('/{usuario}', [UsuarioController::class, 'update'])->name('usuario.update');
    Route::delete('/{usuario}', [UsuarioController::class, 'destroy'])->name('usuario.delete');
});

//Area
Route::group(['prefix' => 'area', 'middleware' => ['can:area.index', 'auth']], function () {
    Route::get('/', [AreaController::class, 'index'])->name('area.index');
    Route::get('/create', [AreaController::class, 'create'])->name('area.create');
    Route::post('/', [AreaController::class, 'store'])->name('area.store');
    Route::get('/edit/{area}', [AreaController::class, 'edit'])->name('area.edit');
    Route::put('/{area}', [AreaController::class, 'update'])->name('area.update');
    Route::delete('/{area}', [AreaController::class, 'destroy'])->name('area.delete');
});

//Cargo
Route::group(['prefix' => 'cargo', 'middleware' => ['can:cargo.index', 'auth']], function () {
    Route::get('/', [CargoController::class, 'index'])->name('cargo.index');
    Route::get('/create', [CargoController::class, 'create'])->name('cargo.create');
    Route::post('/', [CargoController::class, 'store'])->name('cargo.store');
    Route::get('/edit/{cargo}', [CargoController::class, 'edit'])->name('cargo.edit');
    Route::put('/{cargo}', [CargoController::class, 'update'])->name('cargo.update');
    Route::delete('/{cargo}', [CargoController::class, 'destroy'])->name('cargo.delete');
});

// Perfil
Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

//Modulos
Route::group(['prefix' => 'modulo', 'middleware' => ['can:modulo.index', 'auth']], function () {
    Route::get('/', [ModuloController::class, 'index'])->name('modulo.index');
    Route::get('/create', [ModuloController::class, 'create'])->name('modulo.create');
    Route::post('/store', [ModuloController::class, 'store'])->name('modulo.store');
    Route::get('/edit/{modulo}', [ModuloController::class, 'edit'])->name('modulo.edit');
    Route::get('/show/{modulo}', [ModuloController::class, 'show'])->name('modulo.show');
    Route::get('/proceso/{modulo}/{proceso}', [ModuloController::class, 'proceso'])->name('modulo.proceso');
    Route::put('/update/{modulo}', [ModuloController::class, 'update'])->name('modulo.update');
    Route::delete('/delete/{modulo}', [ModuloController::class, 'destroy'])->name('modulo.delete');
});

// Requisitos
Route::group(['prefix' => 'requisito', 'middleware' => ['can:requisito.index', 'auth']], function () {
    Route::get('/', [RequisitosController::class, 'index'])->name('requisito.index');
    Route::get('/create', [RequisitosController::class, 'create'])->name('requisito.create');
    Route::post('/store', [RequisitosController::class, 'store'])->name('requisito.store');
    Route::get('/edit/{requisito}', [RequisitosController::class, 'edit'])->name('requisito.edit');
    Route::put('/update/{requisito}', [RequisitosController::class, 'update'])->name('requisito.update');
    Route::delete('/delete/{requisito}', [RequisitosController::class, 'destroy'])->name('requisito.delete');
});

// Procesos
Route::group(['prefix' => 'procesos', 'middleware' => ['can:procesos.index', 'auth']], function () {
    Route::get('/', [ProcesosController::class, 'index'])->name('procesos.index');
    Route::get('/create', [ProcesosController::class, 'create'])->name('procesos.create');
    Route::post('/store', [ProcesosController::class, 'store'])->name('procesos.store');
    Route::get('/edit/{procesos}', [ProcesosController::class, 'edit'])->name('procesos.edit');
    Route::put('/update/{procesos}', [ProcesosController::class, 'update'])->name('procesos.update');
    Route::delete('/delete/{procesos}', [ProcesosController::class, 'destroy'])->name('procesos.delete');
});

// Estudiantes
Route::group(['prefix' => 'estudiante', 'middleware' => ['can:estudiante.index', 'auth']], function () {
    Route::get('/', [EstudianteController::class, 'index'])->name('estudiante.index');
    Route::get('/create', [EstudianteController::class, 'create'])->name('estudiante.create');
    Route::get('/show/notas/{estudiante}/{programa}', [EstudianteController::class, 'showNotas'])->name('estudiante.showNotas');
    Route::get('/inscribirse/{estudiante}', [EstudianteController::class, 'newprogram'])->name('estudiante.newprogram');
    Route::get('/show/{estudiante}', [EstudianteController::class, 'show'])->name('estudiante.show');
    Route::get('/estado/{estudiante}', [EstudianteController::class, 'estado'])->name('estudiante.estado');
    Route::get('/edit/{estudiante}', [EstudianteController::class, 'edit'])->name('estudiante.edit');
    Route::get('/carta/create/{estudiante}/{titulacion}/{tipo}', [CartaTitulacion::class, 'cartaCreate'])->name('estudiante.cartaCreate');
    Route::get('/titulacion/create/{estudiante}/{programa}', [CartaTitulacion::class, 'titulacionCreate'])->name('estudiante.titulacionCreate');
    Route::get('/titulacion/edit/{titulacion}', [CartaTitulacion::class, 'titulacionEdit'])->name('estudiante.titulacionEdit');
    Route::get('/carta/{estudiante}/{programa}', [CartaTitulacion::class, 'carta'])->name('estudiante.carta');
    Route::put('/update/{estudiante}', [EstudianteController::class, 'update'])->name('estudiante.update');
    Route::post('/store', [EstudianteController::class, 'store'])->name('estudiante.store');
    Route::post('/carta/store/{estudiante}/{titulacion}/{tipo}', [CartaTitulacion::class, 'cartaStore'])->name('estudiante.cartaStore');
    Route::post('/titulacion/store/{estudiante}/{programa}', [CartaTitulacion::class, 'titulacionStore'])->name('estudiante.titulacionStore');
    Route::post('/titulacion/update/{titulacion}', [CartaTitulacion::class, 'titulacionUpdate'])->name('estudiante.titulacionUpdate');
    Route::post('/inscribirse/store/{estudiante}', [EstudianteController::class, 'storenewprogram'])->name('estudiante.storenewprogram');
    Route::delete('/carta/delete/{titulacion}', [CartaTitulacion::class, 'cartaDestroy'])->name('estudiante.cartaDestroy');
    Route::delete('/titulacion/delete/{titulacion}', [CartaTitulacion::class, 'titulacionDestroy'])->name('estudiante.titulacionDestroy');
    Route::delete('/delete/documento/{documento}', [EstudianteController::class, 'deleteFile'])->name('estudiante.deleteFile');
    Route::delete('/delete/{estudiante}', [EstudianteController::class, 'destroy'])->name('estudiante.delete');
});

//Tipo Descuento
Route::group(['prefix' => 'tipo_descuento', 'middleware' => ['can:descuento.index', 'auth']], function () {
    Route::get('/', [Tipo_descuentoController::class, 'index'])->name('descuento.index');
    Route::get('/create', [Tipo_descuentoController::class, 'create'])->name('descuento.create');
    Route::post('/store', [Tipo_descuentoController::class, 'store'])->name('descuento.store');
    Route::get('/edit/{descuento}', [Tipo_descuentoController::class, 'edit'])->name('descuento.edit');
    Route::put('/update/{descuento}', [Tipo_descuentoController::class, 'update'])->name('descuento.update');
});

//Tipo Pago
Route::group(['prefix' => 'tipo_pago', 'middleware' => ['can:tipo_pago.index', 'auth']], function () {
    Route::get('/', [tipo_pagoController::class, 'index'])->name('tipo_pago.index');
    Route::get('/create', [tipo_pagoController::class, 'create'])->name('tipo_pago.create');
    Route::post('/store', [tipo_pagoController::class, 'store'])->name('tipo_pago.store');
    Route::get('/edit/{pago}', [tipo_pagoController::class, 'edit'])->name('tipo_pago.edit');
    Route::put('/update/{tipo_pago}', [tipo_pagoController::class, 'update'])->name('tipo_pago.update');
});

//Pago Estudiante
Route::group(['prefix' => 'pago_estudiante', 'middleware' => ['can:pago_estudiante.index', 'auth']], function () {
    Route::get('/', [Pago_EstudianteController::class, 'index'])->name('pago_estudiante.index');
    Route::get('/create/{estudiante}', [Pago_EstudianteController::class, 'create'])->name('pago_estudiante.create');
    Route::get('/edit/{id}', [Pago_EstudianteController::class, 'edit'])->name('pago_estudiante.edit');
    Route::post('/store/{estudiante}', [Pago_EstudianteController::class, 'store'])->name('pago_estudiante.store');
    Route::get('/show/{estudiante}', [Pago_EstudianteController::class, 'show'])->name('pago_estudiante.show');
    Route::get('/show/programa/{pago_estudiante}', [Pago_EstudianteController::class, 'show_programa'])->name('pago_estudiante.show_programa');
    Route::put('/update/{estudiante}', [Pago_EstudianteController::class, 'update'])->name('pago_estudiante.update');
});

//Pago
Route::group(['prefix' => 'pago', 'middleware' => ['can:pago.index', 'auth']], function () {
    Route::get('/', [PagoController::class, 'index'])->name('pago.index');
    Route::get('/create/{id}', [PagoController::class, 'create'])->name('pago.create');
    Route::get('/edit/{pago}', [PagoController::class, 'edit'])->name('pago.edit');
    Route::post('/store/{id}', [PagoController::class, 'store'])->name('pago.store');
    Route::put('update/{pago}', [PagoController::class, 'update'])->name('pago.update');
    Route::get('/pdf/{id}', [PagoController::class, 'pdf'])->name('pago.pdf');
    Route::delete('/delete/{pago}', [PagoController::class, 'destroy'])->name('pago.delete');
});

// Programas
Route::group(['prefix' => 'programa', 'middleware' => ['can:programa.index', 'auth']], function () {
    Route::get('/', [ProgramaController::class, 'index'])->name('programa.index');
    Route::get('/create', [ProgramaController::class, 'create'])->name('programa.create');
    Route::get('/edit/{programa}', [ProgramaController::class, 'edit'])->name('programa.edit');
    Route::get('/show/{programa}', [ProgramaController::class, 'show'])->name('programa.show');
    Route::get('/grafica/{programa}', [ProgramaController::class, 'grafica'])->name('programa.grafica');
    Route::get('/editable/{programa}', [ProgramaController::class, 'editable'])->name('programa.editable');
    Route::delete('/delete/{programa}', [ProgramaController::class, 'destroy'])->name('programa.delete');
    Route::get('/show/modulo/init/{programa}/{modulo}', [ProgramaController::class, 'init'])->name('programa.init');
    Route::get('/show/modulo/notas/{programa}/{modulo}', [ProgramaController::class, 'notas'])->name('programa.notas');
    Route::get('/show/modulo/inscritos/{programa}/{modulo}', [ProgramaController::class, 'actInscritos'])->name('programa.inscritos');
    Route::get('/show/modulo/{programa}/{modulo}', [ProgramaController::class, 'modulo'])->name('programa.modulo');
});

// Tic
Route::group(['prefix' => 'tic', 'middleware' => ['can:tic.index', 'auth']], function () {
    Route::get('/', [TicController::class, 'index'])->name('tic.index');
    Route::get('/create', [TicController::class, 'create'])->name('tic.create');
    Route::post('/store', [TicController::class, 'store'])->name('tic.store');
    Route::get('/edit/{tic}', [TicController::class, 'edit'])->name('tic.edit');
    Route::get('/show/{tic}', [TicController::class, 'show'])->name('tic.show');
    Route::put('/update/{tic}', [TicController::class, 'update'])->name('tic.update');
    Route::delete('/delete/{tic}', [TicController::class, 'destroy'])->name('tic.delete');
});

// Solicitudes
Route::group(['prefix' => 'solicitudes', 'middleware' => ['can:solicitudes.index', 'auth']], function () {
    Route::get('/', [SolicitudController::class, 'index'])->name('solicitudes.index')->can('solicitudes.index');
    Route::get('/create', [SolicitudController::class, 'create'])->name('solicitudes.create');
    Route::post('/store', [SolicitudController::class, 'store'])->name('solicitudes.store');
    Route::get('/confirmar/{id}', [SolicitudController::class, 'confirmar'])->name('solicitudes.confirmar');
    Route::get('/show/{solicitudes}', [SolicitudController::class, 'show'])->name('solicitudes.show')->can('solicitudes.show');
    Route::delete('/delete/{solicitudes}', [SolicitudController::class, 'destroy'])->name('solicitudes.delete');
});

Route::get('inventario/index', [InventarioController::class, 'index'])->name('inventario.index')->middleware('auth');

// Inventario
Route::group(['prefix' => 'inventario', 'middleware' => ['can:inventario.index', 'auth']], function () {
    Route::get('/create', [InventarioController::class, 'create'])->name('inventario.create');
    Route::post('/store', [InventarioController::class, 'store'])->name('inventario.store');
    Route::get('/edit/{inventario}', [InventarioController::class, 'edit'])->name('inventario.edit');
    Route::put('/update/{inventario}', [InventarioController::class, 'update'])->name('inventario.update');
    Route::delete('/delete/{inventario}', [InventarioController::class, 'destroy'])->name('inventario.delete');
});

// Activo Fijo
Route::group(['prefix' => 'activo_fijo', 'middleware' => ['can:activo.index', 'auth']], function () {
    Route::get('/', [ActivoFijoController::class, 'index'])->name('activo.index');
    Route::get('/create', [ActivoFijoController::class, 'create'])->name('activo.create');
    Route::post('/store', [ActivoFijoController::class, 'store'])->name('activo.store');
    Route::get('/edit/{activo}', [ActivoFijoController::class, 'edit'])->name('activo.edit');
    Route::put('/update/{activo}', [ActivoFijoController::class, 'update'])->name('activo.update');
    Route::delete('/delete/{activo}', [ActivoFijoController::class, 'destroy'])->name('activo.delete');
});

// Unidad organizacional
Route::group(['prefix' => 'unidad_organizacional', 'middleware' => ['can:unidad.index', 'auth']], function () {
    Route::get('/', [UnidadOrganizacionalController::class, 'index'])->name('unidad.index');
    Route::get('/create', [UnidadOrganizacionalController::class, 'create'])->name('unidad.create');
    Route::post('/store', [UnidadOrganizacionalController::class, 'store'])->name('unidad.store');
    Route::get('/edit/{unidad}', [UnidadOrganizacionalController::class, 'edit'])->name('unidad.edit');
    Route::put('/update/{unidad}', [UnidadOrganizacionalController::class, 'update'])->name('unidad.update');
    Route::delete('/delete/{unidad}', [UnidadOrganizacionalController::class, 'destroy'])->name('unidad.delete');
});

// recepcion de la documentacion
Route::group(['prefix' => 'recepcion', 'middleware' => ['can:recepcion.index', 'auth']], function () {
    Route::get('/', [RecepcionController::class, 'index'])->name('recepcion.index');       // list of all documents
    Route::get('/create', [RecepcionController::class, 'create'])->name('recepcion.create');    // create a new recepcion
    Route::post('/store', [RecepcionController::class, 'store'])->name('recepcion.store');  // store a new recepcion
    Route::get('/show/{recepcion}', [RecepcionController::class, 'show'])->name('recepcion.show');    // show a recepcion
    Route::get('/edit/{recepcion}', [RecepcionController::class, 'edit'])->name('recepcion.edit');    // edit a recepcion
    Route::put('/update/{recepcion}', [RecepcionController::class, 'update'])->name('recepcion.update');  // update a recepcion
    Route::delete('/delete/{recepcion}', [RecepcionController::class, 'destroy'])->name('recepcion.delete'); // delete a recepcion
});

// Movimiento de la documentacion
Route::group(['prefix' => 'movimiento', 'middleware' => ['can:movimiento.index', 'auth']], function () {
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
Route::group(['prefix' => 'servicio', 'middleware' => ['can:servicio.index', 'auth']], function () {
    Route::get('/', [ServicioController::class, 'index'])->name('servicio.index');
    Route::get('/create', [ServicioController::class, 'create'])->name('servicio.create');
    Route::get('/edit/{servicio}', [ServicioController::class, 'edit'])->name('servicio.edit');
    Route::post('/store', [ServicioController::class, 'store'])->name('servicio.store');
    Route::put('/update/{servicio}', [ServicioController::class, 'update'])->name('servicio.update');
});

//Pago de Servicios
Route::group(['prefix' => 'pago_servicio', 'middleware' => ['can:pago_servicio.index', 'auth']], function () {
    Route::get('/', [Pago_ServicioController::class, 'index'])->name('pago_servicio.index');
    Route::get('/create', [Pago_ServicioController::class, 'create'])->name('pago_servicio.create');
    Route::get('/edit/{pago}', [Pago_ServicioController::class, 'edit'])->name('pago_servicio.edit');
    Route::post('/store', [Pago_ServicioController::class, 'store'])->name('pago_servicio.store');
    Route::put('/update/{pago}', [Pago_ServicioController::class, 'update'])->name('pago_servicio.update');
});

//Partida
Route::group(['prefix' => 'partida', 'middleware' => ['can:partida.index', 'auth']], function () {
    Route::get('/index', [PartidaController::class, 'index'])->name('partida.index');
    Route::get('/create', [PartidaController::class, 'create'])->name('partida.create');
    Route::get('/edit/{partida}', [PartidaController::class, 'edit'])->name('partida.edit');
    Route::post('/store', [PartidaController::class, 'store'])->name('partida.store');
    Route::put('/update/{partida}', [PartidaController::class, 'update'])->name('partida.update');
});

//Sub Partidas
Route::group(['prefix' => 'subpartida', 'middleware' => ['can:partida.index', 'auth']], function () {
    Route::get('/index', [SubPartidaController::class, 'index'])->name('subpartida.index');
    Route::get('/create', [SubPartidaController::class, 'create'])->name('subpartida.create');
    Route::get('/edit/{partida}', [SubPartidaController::class, 'edit'])->name('subpartida.edit');
    Route::post('/store', [SubPartidaController::class, 'store'])->name('subpartida.store');
    Route::put('/update/{partida}', [SubPartidaController::class, 'update'])->name('subpartida.update');
});

//Presupuesto
Route::group(['prefix' => 'presupuesto', 'middleware' => ['can:presupuesto.index', 'auth']], function () {
    Route::get('/index', [PresupuestoController::class, 'index'])->name('presupuesto.index');
    Route::get('/create', [PresupuestoController::class, 'create'])->name('presupuesto.create');
    Route::get('/edit/{presupuesto}', [PresupuestoController::class, 'edit'])->name('presupuesto.edit');
    Route::post('/store', [PresupuestoController::class, 'store'])->name('presupuesto.store');
    Route::put('/update/{presupuesto}', [PresupuestoController::class, 'update'])->name('presupuesto.update');
});

// Contrataciones
Route::group(['prefix' => 'contrataciones', 'middleware' => ['can:contrataciones.index', 'auth']], function () {
    // Route::get('/', [ContratacionesController::class, 'index'])->name('contrataciones.index');
    Route::get('/create/{contrataciones}', [ContratacionesController::class, 'create'])->name('contrataciones.create');
    Route::get('/edit/{contrataciones}', [ContratacionesController::class, 'edit'])->name('contrataciones.edit');
    Route::get('/show/{contrataciones}', [ContratacionesController::class, 'show'])->name('contrataciones.show');
    Route::put('/update/{contrataciones}', [ContratacionesController::class, 'update'])->name('contrataciones.update');
    Route::post('/store', [ContratacionesController::class, 'store'])->name('contrataciones.store');
    Route::delete('/delete/{contrataciones}', [ContratacionesController::class, 'destroy'])->name('contrataciones.delete');
});

// Cartas de contrataciones
Route::group(['prefix' => 'contratacion/carta', 'middleware' => ['can:contratacion.index', 'auth']], function () {
    Route::get('/create/{idContrato}/{tipoCarta}', [CartaController::class, 'carta_create'])->name('carta.create');
    Route::post('/store', [CartaController::class, 'carta_store'])->name('carta.store');
    Route::get('/edit/{carta}', [CartaController::class, 'carta_edit'])->name('carta.edit');
    Route::put('/update/{carta}', [CartaController::class, 'carta_update'])->name('carta.update');
    Route::delete('/delete/{carta}', [CartaController::class, 'carta_delete'])->name('carta.delete');
    Route::post('/pdf', [CartasReporteController::class, 'index'])->name('carta.index');
    Route::get('/pdf/{id}/{tipo}/{idCarta}', [CartasReporteController::class, 'pdf'])->name('carta.pdf');
});

// Directivos
Route::group(['prefix' => 'directivos', 'middleware' => ['can:directivos.index', 'auth']], function () {
    Route::get('/', [DirectivoController::class, 'index'])->name('directivo.index');
    Route::get('/create', [DirectivoController::class, 'create'])->name('directivo.create');
    Route::get('/edit/{directivo}', [DirectivoController::class, 'edit'])->name('directivo.edit');
    Route::post('/store', [DirectivoController::class, 'store'])->name('directivo.store');
    Route::put('/update/{directivo}', [DirectivoController::class, 'update'])->name('directivo.update');
    Route::delete('/delete/{directivo}', [DirectivoController::class, 'destroy'])->name('directivo.delete');
});

// Pagos sueldos
Route::group(['prefix' => 'sueldos', 'middleware' => ['can:sueldos.index', 'auth']], function () {
    Route::get('/', [SueldosController::class, 'index'])->name('sueldos.index');
    Route::get('/create', [SueldosController::class, 'create'])->name('sueldos.create');
    Route::delete('/delete/{sueldos}', [SueldosController::class, 'destroy'])->name('sueldos.delete');
});

// Docentes
Route::group(['prefix' => 'docentes', 'middleware' => ['can:docentes.index', 'auth']], function () {
    Route::get('/', [DocentesController::class, 'index'])->name('docentes.index');
    Route::get('/create', [DocentesController::class, 'create'])->name('docentes.create');
    Route::post('/store', [DocentesController::class, 'store'])->name('docentes.store');
    Route::get('/edit/{docentes}', [DocentesController::class, 'edit'])->name('docentes.edit');
    Route::get('/show/{docentes}', [DocentesController::class, 'show'])->name('docentes.show');
    Route::put('/update/{docentes}', [DocentesController::class, 'update'])->name('docentes.update');
    Route::delete('/delete/{docentes}', [DocentesController::class, 'destroy'])->name('docentes.delete');
});

//Third Partida
Route::group(['prefix' => 'thirdpartida', 'middleware' => ['can:partida.index', 'auth']], function () {
    Route::get('/index', [ThirdPartidaController::class, 'index'])->name('t_partida.index');
    Route::get('/create', [ThirdPartidaController::class, 'create'])->name('t_partida.create');
    Route::get('/edit/{partida}', [ThirdPartidaController::class, 'edit'])->name('t_partida.edit');
    Route::post('/store', [ThirdPartidaController::class, 'store'])->name('t_partida.store');
    Route::put('/update/{partida}', [ThirdPartidaController::class, 'update'])->name('t_partida.update');
});

//Quarter Partida
Route::group(['prefix' => 'quarterpartida', 'middleware' => ['can:partida.index', 'auth']], function () {
    Route::get('/index', [QuarterPartidaController::class, 'index'])->name('c_partida.index');
    Route::get('/create', [QuarterPartidaController::class, 'create'])->name('c_partida.create');
    Route::get('/edit/{partida}', [QuarterPartidaController::class, 'edit'])->name('c_partida.edit');
    Route::post('/store', [QuarterPartidaController::class, 'store'])->name('c_partida.store');
    Route::put('/update/{partida}', [QuarterPartidaController::class, 'update'])->name('c_partida.update');
});

//Quinta Partida
Route::group(['prefix' => 'fifthpartida', 'middleware' => ['can:partida.index', 'auth']], function () {
    Route::get('/index', [FifthPartidaController::class, 'index'])->name('f_partida.index');
    Route::get('/create', [FifthPartidaController::class, 'create'])->name('f_partida.create');
    Route::get('/edit/{partida}', [FifthPartidaController::class, 'edit'])->name('f_partida.edit');
    Route::post('/store', [FifthPartidaController::class, 'store'])->name('f_partida.store');
    Route::put('/update/{partida}', [FifthPartidaController::class, 'update'])->name('f_partida.update');
});

//Factura
Route::group(['prefix' => 'factura', 'middleware' => ['can:factura.index', 'auth']], function () {
    Route::get('/index', [FacturaController::class, 'index'])->name('factura.index');
    Route::get('/create', [FacturaController::class, 'create'])->name('factura.create');
    Route::get('/edit/{factura}', [FacturaController::class, 'edit'])->name('factura.edit');
    Route::post('/store', [FacturaController::class, 'store'])->name('factura.store');
    Route::put('/update/{factura}', [FacturaController::class, 'update'])->name('factura.update');
});

//Detalle Factura
Route::group(['prefix' => 'detalle_factura', 'middleware' => ['can:detalle_factura.index', 'auth']], function () {
    Route::get('/index/{id}', [DetalleFacturaController::class, 'index'])->name('detalle_factura.index');
    Route::get('/create/{id}', [DetalleFacturaController::class, 'create'])->name('detalle_factura.create');
    Route::get('/edit/{id}', [DetalleFacturaController::class, 'edit'])->name('detalle_factura.edit');
    Route::post('/store/{id}', [DetalleFacturaController::class, 'store'])->name('detalle_factura.store');
    Route::delete('/destroy/{id}', [DetalleFacturaController::class, 'destroy'])->name('detalle_factura.delete');
    Route::put('/update/{id}', [DetalleFacturaController::class, 'update'])->name('detalle_factura.update');
});

// Roles
Route::group(['prefix' => 'roles', 'middleware' => ['can:roles.index', 'auth']], function () {
    Route::get('/', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
    Route::get('/edit/{rol}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::delete('/{rol}', [RoleController::class, 'destroy'])->name('roles.delete');
});

// Contratacion administrativos
Route::group(['prefix' => 'contratacion', 'middleware' => ['can:contratacion.index', 'auth']], function () {
    Route::get('/create/{contratacion}', [ContratacionController::class, 'create'])->name('contratacion.create');
    Route::post('/store', [ContratacionController::class, 'store'])->name('contratacion.store');
    Route::get('/edit/{contratacion}', [ContratacionController::class, 'edit'])->name('contratacion.edit');
    Route::get('/show/{contratacion}', [ContratacionController::class, 'show'])->name('contratacion.show');
    Route::put('/update/{contratacion}', [ContratacionController::class, 'update'])->name('contratacion.update');
    Route::delete('/delete/{contratacion}', [ContratacionController::class, 'destroy'])->name('contratacion.delete');
});

// Administrativos
Route::group(['prefix' => 'administrativos', 'middleware' => ['can:administrativo.index', 'auth']], function () {
    Route::get('/', [AdministrativoController::class, 'index'])->name('administrativo.index');
    Route::get('/create', [AdministrativoController::class, 'create'])->name('administrativo.create');
    Route::post('/store', [AdministrativoController::class, 'store'])->name('administrativo.store');
    Route::get('/edit/{id}', [AdministrativoController::class, 'edit'])->name('administrativo.edit');
    Route::get('/show/{administrativo}', [AdministrativoController::class, 'show'])->name('administrativo.show');
    Route::put('/update/{id}', [AdministrativoController::class, 'update'])->name('administrativo.update');
    Route::delete('/delete/{administrativo}', [AdministrativoController::class, 'destroy'])->name('administrativo.delete');
});

// Marketing
Route::group(['prefix' => 'marketing', 'middleware' => ['can:marketing.index', 'auth']], function () {
    Route::get('/', [MarketingController::class, 'index'])->name('marketing.index');
    Route::get('/create', [MarketingController::class, 'create'])->name('marketing.create');
    Route::post('/store', [MarketingController::class, 'store'])->name('marketing.store');
    Route::get('/edit/{marketing}', [MarketingController::class, 'edit'])->name('marketing.edit');
    Route::get('/show/{marketing}', [MarketingController::class, 'show'])->name('marketing.show');
    Route::put('/update/{marketing}', [MarketingController::class, 'update'])->name('marketing.update');
    Route::delete('/delete/{marketing}', [MarketingController::class, 'destroy'])->name('marketing.delete');
});

// Eventos
Route::group(['prefix' => 'eventos', 'middleware' => ['can:eventos.index', 'auth']], function () {
    Route::get('/', [EventoController::class, 'index'])->name('eventos.index');
    Route::get('/create', [EventoController::class, 'create'])->name('eventos.create');
    Route::post('/store', [EventoController::class, 'store'])->name('eventos.store');
    Route::get('/edit/{eventos}', [EventoController::class, 'edit'])->name('eventos.edit');
    Route::get('/show/{eventos}', [EventoController::class, 'show'])->name('eventos.show');
    Route::put('/update/{eventos}', [EventoController::class, 'update'])->name('eventos.update');
    Route::delete('/delete/{eventos}', [EventoController::class, 'destroy'])->name('eventos.delete');
});

// Universidad
Route::group(['prefix' => 'universidad', 'middleware' => ['can:universidad.index', 'auth']], function () {
    Route::get('/', [UniversidadController::class, 'index'])->name('universidad.index');
    Route::get('/create', [UniversidadController::class, 'create'])->name('universidad.create');
    Route::post('/store', [UniversidadController::class, 'store'])->name('universidad.store');
    Route::delete('/delete/{universidad}', [UniversidadController::class, 'destroy'])->name('universidad.delete');
});

// Carreras
Route::group(['prefix' => 'carreras', 'middleware' => ['can:carreras.index', 'auth']], function () {
    Route::get('/', [CarreraController::class, 'index'])->name('carreras.index');
    Route::get('/create', [CarreraController::class, 'create'])->name('carreras.create');
    Route::post('/store', [CarreraController::class, 'store'])->name('carreras.store');
    Route::delete('/delete/{carreras}', [CarreraController::class, 'destroy'])->name('carreras.delete');
});
