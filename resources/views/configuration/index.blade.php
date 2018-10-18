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
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item">Configuration</li>
            </ol>
        </nav>

        <div class="card-body">
            
        </div>
    </div>
</div>
@endsection
