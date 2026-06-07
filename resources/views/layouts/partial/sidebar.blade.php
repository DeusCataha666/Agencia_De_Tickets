<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/home') }}" class="brand-link d-flex justify-content-center py-4">
        <img src="{{ asset('backend/dist/img/ticket_logo.png')}}" alt="Logo" style="opacity: 0.9; max-width: 100%; max-height: 60px; height: auto; width: auto; display: block; margin: 0 auto;">
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('/home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Panel De Control</p>
                    </a>
                </li>
                
                <li class="nav-item mt-2">
                    <a href="{{route('tickets.index')}}" class="nav-link {{ request()->is('tickets*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-ticket-alt"></i>
                        <p>Tickets</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('clientes.index')}}" class="nav-link {{ request()->is('clientes*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-handshake"></i>
                        <p>Clientes</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('usuarios.index')}}" class="nav-link {{ request()->is('usuarios*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Usuarios</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('tipousuarios.index')}}" class="nav-link {{ request()->is('tipousuarios*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-tag"></i>
                        <p>Tipos de Usuario</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('comentarios.index')}}" class="nav-link {{ request()->is('comentarios*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>Comentarios</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>