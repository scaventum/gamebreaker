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
                    <li class="breadcrumb-item active" aria-current="page">View - {{$post->id}}</li>
                </ol>
            </nav>

            <div class="card content-list bg-light">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 mb-3">
                            <div class="embed-responsive embed-responsive-16by9">
                                <video class="embed-responsive-item" controls>
                                    <source src="{{asset('storage/vid/posts/'.$post->id.'/'.$post->video)}}" >
                                </video>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h3 class="card-title">
                                        <img src="{{asset('storage/img/games/'.$post->game->id.'/'.$post->game->logo)}}" height="30" class="d-inline-block" alt="">
                                        {!!$post->title!!}
                                    </h3>
                                </div>
                                <div class="col-sm-4 text-right">
                                    {!! Form::open(['action' => ['DashboardController@destroy', $post->id],'method' => 'POST']) !!}
                                        @method('DELETE')
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a title="Update" href="/dashboard/{{$post->id}}/edit" class="btn btn-secondary btn-sm"><i class="far fa-edit"></i></a>
                                            @if(App\Post::is_delete($post->id))
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Delete data?')"><i class="fas fa-eraser"></i></button>
                                            @endif
                                        </div>
                                    {!! Form::close() !!}
                                </div>  
                            </div>
                            <p>{!!$post->description!!}</p>
                            <small class="post-like-count">{{$post->get_like($post->id)}}</small>
                            <i class="far fa-thumbs-up"></i>
                            <hr>
                            <small>Last update by {{$post->user->name}} at {{date("d M Y H:i:s",strtotime($post->updated_at))}}</small>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection