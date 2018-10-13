@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header-admin">
            <div class="row">
                <div class="col-sm-8">
                    <div class="page-header-admin-title" title="{{$subheader}}">{!!$head_icon!!} {{$header}}</div>
                </div>
                <div class="col-sm-4 text-right">
                    <a href="/carousels/create" class="btn btn-outline-light"><i class="fas fa-plus"></i> Create</a>
                </div>
            </div>
        </div>
        <div class="content-admin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/carousels">Carousels</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$carousel->id}}</li>
                </ol>
            </nav>

            <div class="card content-list bg-light">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="{{asset('img/carousel/'.$carousel['img'])}}" class="img-fluid img-thumbnail">
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                                <h3 class="card-title">
                                    {!!$carousel->caption!!}
                                    {!!($carousel->activity>0?"<i class='fas fa-toggle-on text-success'></i>":"<i class='fas fa-toggle-off text-danger'></i>")!!}
                                </h3>
                                <p>{!!$carousel->subcaption!!}</p>
                                <hr>
                                <small>Last update at {{date("d M Y H:i:s",strtotime($carousel->updated_at))}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection