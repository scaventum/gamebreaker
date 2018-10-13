@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header-admin">
            <div class="row">
                <div class="col-sm-8">
                    <div class="page-header-admin-title" title="{{$subheader}}">{!!$head_icon!!} {{$header}}</div>
                </div>
                <div class="col-sm-4 text-right">
                    <a href="/carousels/create" class="btn btn-outline-light"><i class="fas fa-plus" title="Create"></i></a>
                </div>
            </div>
        </div>

        <div class="content-admin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item">Carousels</li>
                </ol>
            </nav>

            @if(count($carousels)>0)
                {{$carousels->links()}}
                @foreach($carousels as $carousel)
                    <div class="card content-list bg-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h5 class="card-title">
                                        <a href="/carousels/{{$carousel->id}}">{{strip_tags($carousel->caption)}}</a>
                                        {!!($carousel->activity>0?"<i class='fas fa-toggle-on text-success'></i>":"<i class='fas fa-toggle-off text-danger'></i>")!!}
                                    </h5>
                                </div>
                                <div class="col-sm-4 text-right">
                                    <a title="View" href="/carousels/{{$carousel->id}}" class="btn btn-success"><i class="far fa-eye"></i></a>
                                    <a title="Update" href="/carousels/{{$carousel->id}}/edit" class="btn btn-primary"><i class="far fa-edit"></i></a>
                                </div>
                            </div>
                            <hr>
                            <small>Last update at {{date("d M Y H:i:s",strtotime($carousel->updated_at))}}</small>
                        </div>
                    </div>
                @endforeach
                {{$carousels->links()}}
            @endif
        </div>
    </div>
@endsection