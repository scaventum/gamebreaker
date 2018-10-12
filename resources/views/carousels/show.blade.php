@extends('layouts.app')

@section('content')
    @include('inc.header_admin')
    <div class="container">
        <div class="content-admin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/carousels">Carousels</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$carousel->id}}</li>
                </ol>
            </nav>

            <div class="card card-body bg-light content-list">
                <h3>{!!$carousel->caption!!}</h3>
                <p>{{$carousel->subcaption}}</p>
                <hr>
                <small>Last update at {{date("d M Y H:i:s",strtotime($carousel->updated_at))}}</small>
            </div>
        </div>
    </div>
@endsection