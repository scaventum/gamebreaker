@extends('layouts.app')

@section('content')
<div class="container">
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

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            You are logged in!
        </div>
    </div>
</div>
@endsection
