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
                    <li class="breadcrumb-item"><a href="/carousels">Carousels</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View - {{$carousel->id}}</li>
                </ol>
            </nav>

            <div class="card content-list bg-light">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 mb-3">
                            <img src="{{asset('storage/img/carousels/'.$carousel->img)}}" class="img-fluid img-thumbnail">
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h3 class="card-title">
                                        {!!$carousel->caption!!}
                                        {!!($carousel->activity>0?"<i class='fas fa-toggle-on text-success'></i>":"<i class='fas fa-toggle-off text-danger'></i>")!!}
                                    </h3>
                                </div>
                                <div class="col-sm-4 text-right">
                                    {!! Form::open(['action' => ['CarouselsController@destroy', $carousel->id],'method' => 'POST']) !!}
                                        @method('DELETE')
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a title="Update" href="/carousels/{{$carousel->id}}/edit" class="btn btn-secondary btn-sm"><i class="far fa-edit"></i></a>
                                            @if(App\Carousel::is_delete($carousel->id))
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Delete data?')"><i class="fas fa-eraser"></i></button>
                                            @endif
                                        </div>
                                    {!! Form::close() !!}
                                </div>  
                            </div>
                            <p>{!!$carousel->subcaption!!}</p>
                            <hr>
                            <small>Last update by {{$carousel->user->name}} at {{date("d M Y H:i:s",strtotime($carousel->updated_at))}}</small>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection