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
            <!--<li class="nav-item{{ $activePage == 'usuario' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('usuario.index') }}">
          <i class="material-icons">face</i>
            <p>{{ __('Usuarios') }}</p>
        </a>
      </li> -->
            <li class="nav-item {{ $activePage == 'profile' || $activePage == 'user-management' ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#Usuario" aria-expanded="false">
                    <i class="material-icons">face</i>
                    <p>{{ __('Usuarios') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="Usuario">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('usuario.index') }}">
                                <span class="sidebar-mini"> U </span>
                                <span class="sidebar-normal"> {{ __('Usuario') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('cargo.index') }}">
                                <span class="sidebar-mini"> C </span>
                                <span class="sidebar-normal"> {{ __('Cargo') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('area.index') }}">
                                <span class="sidebar-mini"> A </span>
                                <span class="sidebar-normal"> {{ __('Area') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- <li class="nav-item {{ $activePage == 'profile' || $activePage == 'user-management' ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#Documento" aria-expanded="false">
                    <i class="material-icons">library_books</i>
                    <p>{{ __('Documentacion') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="Documento">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link" href="#">
                                <span class="sidebar-mini"> Doc </span>
                                <span class="sidebar-normal"> {{ __('Documento') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> -->

            <li
                class="nav-item {{ $activePage == 'estudiante' || $activePage == 'requisito' || $activePage == 'tipo_estudio' || $activePage == 'modulo' ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#Academico" aria-expanded="false">
                    <i class="material-icons">schools</i>
                    <p>{{ __('Academico') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="Academico">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'estudiante' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('estudiante.index') }}">
                                <span class="sidebar-mini"> ES </span>
                                <span class="sidebar-normal">{{ __('Estudiantes') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'programa' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('programa.index') }}">
                                <span class="sidebar-mini"> PR </span>
                                <span class="sidebar-normal"> {{ __('Programas') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'modulo' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('modulo.index') }}">
                                <span class="sidebar-mini"> MD </span>
                                <span class="sidebar-normal">{{ __('Módulos') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'requisito' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('requisito.index') }}">
                                <span class="sidebar-mini"> RQ </span>
                                <span class="sidebar-normal"> {{ __('Requisitos') }} </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <li
                class="nav-item {{ $activePage == 'estu' || $activePage == 'descuento' || $activePage == 'tipo_pago' ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#Contabilidad" aria-expanded="false">
                    <i class="material-icons">content_paste</i>
                    <p>{{ __('Contabilidad') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="Contabilidad">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'estu' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('pago_estudiante.index') }}">
                                <span class="sidebar-mini"> ES </span>
                                <span class="sidebar-normal">{{ __('Estudiantes') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'descuento' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('descuento.index') }}">
                                <span class="sidebar-mini"> DESC </span>
                                <span class="sidebar-normal"> {{ __('Descuentos') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'tipo_pago' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('tipo_pago.index') }}">
                                <span class="sidebar-mini"> TP </span>
                                <span class="sidebar-normal">{{ __('Tipo de Pago') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li
                class="nav-item {{ $activePage == 'inventario' || $activePage == 'user-management' ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#Tics" aria-expanded="false">
                    <i class="material-icons">settings</i>
                    <p>{{ __("TIC'S") }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="Tics">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'inventario' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('inventario.index') }}">
                                <span class="sidebar-mini"> IN </span>
                                <span class="sidebar-normal">{{ __('Inventario') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ $activePage == 'activo' || $activePage == 'user-management' ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#administracion" aria-expanded="false">
                    <i class="material-icons">library_books</i>
                    <p>{{ __('Administración') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="administracion">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'activo' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('activo.index') }}">
                                <span class="sidebar-mini"> AC </span>
                                <span class="sidebar-normal">{{ __('Activos') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- <li class="nav-item{{ $activePage == 'map' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('map') }}">
          <i class="material-icons">location_ons</i>
            <p>{{ __('Maps') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('notifications') }}">
          <i class="material-icons">notifications</i>
          <p>{{ __('Notifications') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'language' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('language') }}">
          <i class="material-icons">language</i>
          <p>{{ __('RTL Support') }}</p>
        </a>
      </li>  -->
        </ul>
    </div>
</div>
