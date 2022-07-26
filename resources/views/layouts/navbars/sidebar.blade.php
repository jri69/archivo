<div class="sidebar" data-color="orange" data-background-color="tranparent" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo" data-color="orange" data-background-color="white">    
    <center>
     <img style="width:200px" style="margin-left:20px" src="{{ asset('material') }}/img/logo.jpg" > 
      </center>       
    
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="#">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Inicio') }}</p>
        </a>
      </li>
      <!--<li class="nav-item{{ $activePage == 'usuario' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('usuario.index')}}">
          <i class="material-icons">face</i>
            <p>{{ __('Usuarios') }}</p>
        </a>
      </li> -->
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Usuario" aria-expanded="false">
          <i class="material-icons">face</i>
          <p>{{ __('Usuarios') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="Usuario">
          <ul class="nav">            
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('usuario.index')}}">
                <span class="sidebar-mini"> U </span>
                <span class="sidebar-normal"> {{ __('Usuario') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('cargo.index')}}">
                <span class="sidebar-mini"> C </span>
                <span class="sidebar-normal"> {{ __('Cargo') }} </span>
              </a>
            </li>  
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('area.index')}}">
                <span class="sidebar-mini"> A </span>
                <span class="sidebar-normal"> {{ __('Area') }} </span>
              </a>
            </li>          
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Documento" aria-expanded="false">
          <i class="material-icons">library_books</i>
          <p>{{ __('Documentacion') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="Documento">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('documento.index')}}">
                <span class="sidebar-mini"> Doc </span>
                <span class="sidebar-normal"> {{ __('Documento') }} </span>
              </a>
            </li>            
          </ul>
        </div>
      </li>
      
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Academico" aria-expanded="false">
          <i class="material-icons">schools</i>
          <p>{{ __('Academico') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="Academico">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="#">
                <span class="sidebar-mini"> UD </span>
                <span class="sidebar-normal">{{ __('1') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="#">
                <span class="sidebar-mini"> A </span>
                <span class="sidebar-normal"> {{ __('2') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="#">
                <span class="sidebar-mini"> Doc </span>
                <span class="sidebar-normal"> {{ __('3') }} </span>
              </a>
            </li>            
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Contable" aria-expanded="false">
          <i class="material-icons">content_paste</i>
          <p>{{ __('Contable') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="Contable">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="#">
                <span class="sidebar-mini"> UD </span>
                <span class="sidebar-normal">{{ __('1') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="#">
                <span class="sidebar-mini"> A </span>
                <span class="sidebar-normal"> {{ __('2') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="#">
                <span class="sidebar-mini"> Doc </span>
                <span class="sidebar-normal"> {{ __('3') }} </span>
              </a>
            </li>            
          </ul>
        </div>
      </li>
      <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('icons') }}">
          <i class="material-icons">settings</i>
          <p>{{ __('Soporte Tecnico') }}</p>
        </a>
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
