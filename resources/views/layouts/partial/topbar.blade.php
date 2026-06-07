<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars fa-lg" style="color: #2563EB;"></i>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        @auth
        <div class="user-panel mt-2 pb-3 d-flex align-items-center mr-3">
            <div class="image mr-3">
                @php
                    $userPhotoPath = 'uploads/users/' . Auth::user()->photo;
                @endphp
                @if (!empty(Auth::user()->photo) && file_exists(public_path($userPhotoPath)))
                    <img class="img-circle elevation-1" src="{{ asset($userPhotoPath) }}" alt="{{ Auth::user()->name }}" style="width: 40px; height: 40px;">
                @else
                    <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-1" alt="" style="width: 40px; height: 40px;">
                @endif
            </div>
            <div class="info" style="color: #475569; font-size: 0.9rem;">
                <strong>{{ Auth::user()->name }}</strong>
            </div>
        </div>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" title="Cerrar Sesión" role="button">
                <i class='fas fa-sign-out-alt fa-lg' style='color: #EF4444'></i>
            </a>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none">
                @csrf
            </form>
        </li>
        @endauth
    </ul>
</nav>

