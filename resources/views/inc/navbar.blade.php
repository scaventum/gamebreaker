<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{asset('storage/img/pages/logo.png')}}" width="30" height="30" class="d-inline-block" alt="">
            {!! \App\Configuration::where("key","BRAND")->first()->value !!}<!-- Game<span class="text-danger">Breaker</span> -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::is('games') ? 'active' : '' }}">
                    <a class="nav-link " href="/games">Games</a>
                </li>
                <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
                    <a class="nav-link " href="/about">About</a>
                </li>
            </ul>
            
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Sign In') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                        @endif
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <!-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                        </a> -->
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#"><i class="far fa-id-card"></i> Profile</a>
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