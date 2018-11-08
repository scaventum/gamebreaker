<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{asset('storage/img/pages/logo.png')}}" width="30" height="30" class="d-inline-block" alt="">
            {!! \App\Configuration::find(1)->brand !!}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::is('games-page') ? 'active' : '' }}">
                    <a class="nav-link " href="/games-page">Games</a>
                </li>
                <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
                    <a class="nav-link " href="/about">About</a>
                </li>
            </ul>
            
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Sign In') }} <i class="fas fa-sign-in-alt"></i></a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                            <div class="avatar-24 float-right ml-2"
                            style="background:url({{asset('storage/img/avatars/'.Auth::user()->id.'.png')}}) center center no-repeat;background-size:cover;">
                            </div>
                            
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/profile"><i class="far fa-id-card"></i> Profile</a>
                            <a class="dropdown-item" href="/dashboard"><i class="fas fa-desktop"></i> Dashboard</a>
                            <div class="dropdown-divider"></div>
                            @if( Auth::user()->hasrole('ADMIN') )
                                <a class="dropdown-item text-primary" href="/configuration"><i class="fas fa-cogs"></i> Configuration</a>
                                <a class="dropdown-item text-primary" href="/users"><i class="far fa-user"></i> Users</a>
                                <a class="dropdown-item text-primary" href="/carousels"><i class="far fa-images"></i> Carousels</a>
                                <a class="dropdown-item text-primary" href="/games"><i class="fas fa-gamepad"></i> Games</a>
                                <div class="dropdown-divider"></div>
                            @endif
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Sign Out') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="nav-margin"></div>