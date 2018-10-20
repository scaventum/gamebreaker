@extends('layouts.app')

@section('content')
<div class="container" data-aos="fade-down">
    <div class="page-header-admin">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header-admin-title" title="{{$subheader}}">{!!$head_icon!!} {{$header}}</div>
            </div>
        </div>
    </div>

    <div class="content-admin">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
            </ol>
        </nav>

        @if( Auth::user()->hasrole('ADMIN') )
            <div class="btn-group bm-3 d-none d-sm-flex">
                <button type="button" class="btn btn-primary"><i class="fab fa-teamspeak"></i></button>
                <a href="/configuration" role="button" class="btn btn-outline-primary"><i class="fas fa-cogs"></i> Configuration</a>
                <a href="/users" role="button" class="btn btn-outline-primary"><i class="far fa-user"></i> Users</a>
                <a href="/carousels" role="button" class="btn btn-outline-primary"><i class="far fa-images"></i> Carousels</a>
                <a href="/games" role="button" class="btn btn-outline-primary"><i class="fas fa-gamepad"></i> Games</a>
            </div>
            
            <div class="btn-group-vertical bm-3 d-sm-none btn-block">
                <button type="button" class="btn btn-primary"><i class="fab fa-teamspeak"></i> Administration</button>
                <a href="/configuration" role="button" class="btn btn-outline-primary"><i class="fas fa-cogs"></i> Configuration</a>
                <a href="/users" role="button" class="btn btn-outline-primary"><i class="far fa-user"></i> Users</a>
                <a href="/carousels" role="button" class="btn btn-outline-primary"><i class="far fa-images"></i> Carousels</a>
                <a href="/games" role="button" class="btn btn-outline-primary"><i class="fas fa-gamepad"></i> Games</a>
            </div>
        @endif

    </div>
</div>
@endsection
