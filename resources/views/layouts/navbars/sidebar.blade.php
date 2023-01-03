<div class="sidebar" data-color="orange" data-background-color="tranparent"
    data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo" data-color="orange" data-background-color="white">
        <center>
            <img style="width:200px" style="margin-left:20px" src="{{ asset('material') }}/img/logo.jpg">
        </center>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a class="nav-link" href="/">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Inicio') }}</p>
                </a>
            </li>
            @can('marketing.index')
                <li class="nav-item{{ $activePage == 'marketing' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('marketing.index') }}">
                        <i class="material-icons">addchart</i>
                        <p>{{ __('Marketing') }}</p>
                    </a>
                </li>
            @endcan
            @can('calendario.index')
                <li class="nav-item{{ $activePage == 'calendar' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('calendario.index') }}">
                        <i class="material-icons">calendar_month</i>
                        <p>{{ __('Calendario') }}</p>
                    </a>
                </li>
            @endcan
            @can('eventos.index')
                <li class="nav-item{{ $activePage == 'eventos' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('eventos.index') }}">
                        <i class="material-icons">event</i>
                        <p>{{ __('Eventos') }}</p>
                    </a>
                </li>
            @endcan
            @if (auth()->user()->can('usuario.index') ||
                auth()->user()->can('cargo.index') ||
                auth()->user()->can('area.index') ||
                auth()->user()->can('rol.index'))
                <li
                    class="nav-item {{ $activePage == 'usuario' || $activePage == 'area' || $activePage == 'cargo' || $activePage == 'roles' || $activePage == 'user-management' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#Usuario" aria-expanded="false">
                        <i class="material-icons">face</i>
                        <p>{{ __('Usuarios') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="Usuario">
                        <ul class="nav">
                            @can('usuario.index')
                                <li class="nav-item{{ $activePage == 'usuario' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('usuario.index') }}">
                                        <span class="sidebar-mini"> U </span>
                                        <span class="sidebar-normal"> {{ __('Usuario') }} </span>
                                    </a>
                                </li>
                            @endcan
                            @can('cargo.index')
                                <li class="nav-item{{ $activePage == 'cargo' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('cargo.index') }}">
                                        <span class="sidebar-mini"> C </span>
                                        <span class="sidebar-normal"> {{ __('Cargo') }} </span>
                                    </a>
                                </li>
                            @endcan
                            @can('area.index')
                                <li class="nav-item{{ $activePage == 'area' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('area.index') }}">
                                        <span class="sidebar-mini"> A </span>
                                        <span class="sidebar-normal"> {{ __('Area') }} </span>
                                    </a>
                                </li>
                            @endcan
                            @can('roles.index')
                                <li class="nav-item{{ $activePage == 'roles' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('roles.index') }}">
                                        <span class="sidebar-mini"> R </span>
                                        <span class="sidebar-normal"> {{ __('Roles') }} </span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif


            @if (auth()->user()->can('recepcion.index') ||
                auth()->user()->can('unidad.index'))
                <li
                    class="nav-item {{ $activePage == 'recepcion' || $activePage == 'unidad_organizacional' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#Documento" aria-expanded="false">
                        <i class="material-icons">library_books</i>
                        <p>{{ __('Documentacion') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="Documento">
                        <ul class="nav">
                            @can('recepcion.index')
                                <li class="nav-item{{ $activePage == 'recepcion' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('recepcion.index') }}">
                                        <span class="sidebar-mini"> RC </span>
                                        <span class="sidebar-normal"> {{ __('Recepción') }} </span>
                                    </a>
                                </li>
                            @endcan
                            @can('unidad.index')
                                <li class="nav-item{{ $activePage == 'unidad_organizacional' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('unidad.index') }}">
                                        <span class="sidebar-mini"> UO </span>
                                        <span class="sidebar-normal"> {{ __('Unidad Organizacional') }} </span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif

            @if (auth()->user()->can('estudiante.index') ||
                auth()->user()->can('programa.index') ||
                auth()->user()->can('modulo.index') ||
                auth()->user()->can('requisito.index') ||
                auth()->user()->can('procesos.index'))
                <li
                    class="nav-item {{ $activePage == 'estudiante' || $activePage == 'programa' || $activePage == 'modulo' || $activePage == 'requisito' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#Academico" aria-expanded="false">
                        <i class="material-icons">schools</i>
                        <p>{{ __('Academico') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="Academico">
                        <ul class="nav">
                            @can('estudiante.index')
                                <li class="nav-item{{ $activePage == 'estudiante' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('estudiante.index') }}">
                                        <span class="sidebar-mini"> ES </span>
                                        <span class="sidebar-normal">{{ __('Estudiantes') }} </span>
                                    </a>
                                </li>
                            @endcan
                            @can('programa.index')
                                <li class="nav-item{{ $activePage == 'programa' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('programa.index') }}">
                                        <span class="sidebar-mini"> PR </span>
                                        <span class="sidebar-normal"> {{ __('Programas') }} </span>
                                    </a>
                                </li>
                            @endcan
                            @can('modulo.index')
                                <li class="nav-item{{ $activePage == 'modulo' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('modulo.index') }}">
                                        <span class="sidebar-mini"> MD </span>
                                        <span class="sidebar-normal">{{ __('Módulos') }} </span>
                                    </a>
                                </li>
                            @endcan
                            @can('requisito.index')
                                <li class="nav-item{{ $activePage == 'requisito' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('requisito.index') }}">
                                        <span class="sidebar-mini"> RQ </span>
                                        <span class="sidebar-normal"> {{ __('Requisitos') }} </span>
                                    </a>
                                </li>
                            @endcan
                            @can('procesos.index')
                                <li class="nav-item{{ $activePage == 'procesos' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('procesos.index') }}">
                                        <span class="sidebar-mini"> PR </span>
                                        <span class="sidebar-normal"> {{ __('Procesos') }} </span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif

            @if (auth()->user()->can('descuento.index') ||
                auth()->user()->can('tipo_pago.index') ||
                auth()->user()->can('pago_estudiante.index'))
                <li
                    class="nav-item {{ $activePage == 'Descuento' || $activePage == 'tipo_pago' || $activePage == 'estudiantes' || $activePage == 'user-management' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#Contable" aria-expanded="false">
                        <i class="material-icons">content_paste</i>
                        <p>{{ __('Contabilidad') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="Contable">
                        <ul class="nav">
                            @can('descuento.index')
                                <li class="nav-item{{ $activePage == 'Descuento' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('descuento.index') }}">
                                        <span class="sidebar-mini"> DES </span>
                                        <span class="sidebar-normal">{{ __('Descuento') }} </span>
                                    </a>
                                </li>
                            @endcan
                            @can('tipo_pago.index')
                                <li class="nav-item{{ $activePage == 'tipo_pago' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('tipo_pago.index') }}">
                                        <span class="sidebar-mini"> TP </span>
                                        <span class="sidebar-normal"> {{ __('Tipo de Pagos') }} </span>
                                    </a>
                                </li>
                            @endcan
                            @can('pago_estudiante.index')
                                <li class="nav-item{{ $activePage == 'estudiantes' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('pago_estudiante.index') }}">
                                        <span class="sidebar-mini"> ES </span>
                                        <span class="sidebar-normal"> {{ __('Estudiante') }} </span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif

            @if (auth()->user()->can('inventario.index') ||
                auth()->user()->can('activo.index') ||
                auth()->user()->can('solictud.index') ||
                auth()->user()->can('tic.index'))
                <li
                    class="nav-item {{ $activePage == 'inventario' || $activePage == 'activo' || $activePage == 'user-management' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#Tics" aria-expanded="false">
                        <i class="material-icons">settings</i>
                        <p>{{ __('Inventario') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="Tics">
                        @can('solicitudes.index')
                            <ul class="nav">
                                <li class="nav-item{{ $activePage == 'solicitudes' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('solicitudes.index') }}">
                                        <span class="sidebar-mini"> SC </span>
                                        <span class="sidebar-normal">{{ __('Solicitudes') }} </span>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                        @can('inventario.index')
                            <ul class="nav">
                                <li class="nav-item{{ $activePage == 'inventario' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('inventario.index') }}">
                                        <span class="sidebar-mini"> IN </span>
                                        <span class="sidebar-normal">{{ __('Inventario') }} </span>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                        @can('tic.index')
                            <ul class="nav">
                                <li class="nav-item{{ $activePage == 'tic' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('tic.index') }}">
                                        <span class="sidebar-mini"> TC </span>
                                        <span class="sidebar-normal">{{ __('TIC') }} </span>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                        @can('activo.index')
                            <ul class="nav">
                                <li class="nav-item{{ $activePage == 'activo' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('activo.index') }}">
                                        <span class="sidebar-mini"> AC </span>
                                        <span class="sidebar-normal">{{ __('Activos') }} </span>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                    </div>
                </li>
            @endif

            @if (auth()->user()->can('contrataciones.index') ||
                auth()->user()->can('docentes.index') ||
                auth()->user()->can('directivos.index'))
                <li
                    class="nav-item {{ $activePage == 'contrataciones' || $activePage == 'user-management' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#recursos" aria-expanded="false">
                        <i class="material-icons">library_books</i>
                        <p>{{ __('Recursos Humanos') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="recursos">
                        <ul class="nav">
                            @can('docentes.index')
                                <li class="nav-item{{ $activePage == 'docentes' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('docentes.index') }}">
                                        <span class="sidebar-mini"> DO </span>
                                        <span class="sidebar-normal">{{ __('Docentes') }} </span>
                                    </a>
                                </li>
                            @endcan
                            @can('administrativo.index')
                                <li class="nav-item{{ $activePage == 'administrativo' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('administrativo.index') }}">
                                        <span class="sidebar-mini"> AD </span>
                                        <span class="sidebar-normal">{{ __('Administrativos') }} </span>
                                    </a>
                                </li>
                            @endcan
                            @can('directivos.index')
                                <li class="nav-item{{ $activePage == 'directivos' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('directivo.index') }}">
                                        <span class="sidebar-mini"> DI </span>
                                        <span class="sidebar-normal">{{ __('Directivos') }} </span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif

            @if (auth()->user()->can('pago_servicio.index') ||
                auth()->user()->can('servicio.index'))
                <li
                    class="nav-item {{ $activePage == 'servicio' || $activePage == 'pago_servicio' || $activePage == 'user-management' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#servicio" aria-expanded="false">
                        <i class="material-icons">support_agent</i>
                        <p>{{ __('Servicios') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="servicio">
                        <ul class="nav">
                            @can('pago_servicio.index')
                                <li class="nav-item{{ $activePage == 'pagos' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('pago_servicio.index') }}">
                                        <span class="sidebar-mini"> P </span>
                                        <span class="sidebar-normal">{{ __('Pagos') }} </span>
                                    </a>
                                </li>
                            @endcan
                            @can('servicio.index')
                                <li class="nav-item{{ $activePage == 'servi' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('servicio.index') }}">
                                        <span class="sidebar-mini"> S </span>
                                        <span class="sidebar-normal">{{ __('Servicios') }} </span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif

            @if (auth()->user()->can('presupuesto.index') ||
                auth()->user()->can('partida.index') ||
                auth()->user()->can('factura.index'))
                <li
                    class="nav-item {{ $activePage == 'thirdpartida' || $activePage == 'quarterpartida' || $activePage == 'thirdpartida' || $activePage == 'presupuesto' || $activePage == 'servi' || $activePage == 'user-management' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#partidas" aria-expanded="false">
                        <i class="material-icons">assignment</i>
                        <p>{{ __('Partida') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="partidas">
                        <ul class="nav">
                            @can('presupuesto.index')
                                <li class="nav-item{{ $activePage == 'presupuesto' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('presupuesto.index') }}">
                                        <span class="sidebar-mini"> P </span>
                                        <span class="sidebar-normal">{{ __('Presupuesto') }} </span>
                                    </a>
                                </li>
                            @endcan
                            @can('partida.index')
                                <li class="nav-item{{ $activePage == 'partida' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('partida.index') }}">
                                        <span class="sidebar-mini"> P </span>
                                        <span class="sidebar-normal">{{ __('Partida') }} </span>
                                    </a>
                                </li>
                            @endcan
                            @can('factura.index')
                                <li class="nav-item{{ $activePage == 'factura' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('factura.index') }}">
                                        <span class="sidebar-mini"> CC </span>
                                        <span class="sidebar-normal">{{ __('Caja Chica') }} </span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</div>
