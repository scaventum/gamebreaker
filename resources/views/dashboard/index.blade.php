@extends('layouts.app')

@section('content')
<div class="container" data-aos="fade-down">
    <div class="page-header-admin">
        <div class="row">
            <div class="col-sm-8">
                <div class="page-header-admin-title" title="{{$subheader}}">{!!$head_icon!!} {{$header}}</div>
            </div>
            <div class="col-sm-4 text-right">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="/dashboard/create" class="btn btn-outline-light" title="Create"><i class="fas fa-plus"></i></a>
                </div>
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
            <div class="btn-group mb-3 d-none d-md-flex">
                <a href="/dashboard" role="button" class="btn btn-primary"><i class="fab fa-teamspeak"></i></a>
                <a href="/configuration" role="button" class="btn btn-outline-primary"><i class="fas fa-cogs"></i> Configuration</a>
                <a href="/users" role="button" class="btn btn-outline-primary"><i class="far fa-user"></i> Users</a>
                <a href="/carousels" role="button" class="btn btn-outline-primary"><i class="far fa-images"></i> Carousels</a>
                <a href="/games" role="button" class="btn btn-outline-primary"><i class="fas fa-gamepad"></i> Games</a>
            </div>
            
            <div class="btn-group-vertical mb-3 d-md-none btn-block">
                <a href="/dashboard" role="button" class="btn btn-primary"><i class="fab fa-teamspeak"></i> Administration</a>
                <a href="/configuration" role="button" class="btn btn-outline-primary"><i class="fas fa-cogs"></i> Configuration</a>
                <a href="/users" role="button" class="btn btn-outline-primary"><i class="far fa-user"></i> Users</a>
                <a href="/carousels" role="button" class="btn btn-outline-primary"><i class="far fa-images"></i> Carousels</a>
                <a href="/games" role="button" class="btn btn-outline-primary"><i class="fas fa-gamepad"></i> Games</a>
            </div>
        @endif

        @if(count($posts)>0)
                {{$posts->links()}}
                @foreach($posts as $post)
                    <div class="card content-list bg-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h5 class="card-title">
                                        <a href="/dashboard/{{$post->id}}">
                                            <img src="{{asset('storage/img/games/'.$post->game->id.'/'.$post->game->logo)}}" height="30" class="d-inline-block" alt="">
                                            {{strip_tags($post->title)}}
                                        </a>
                                    </h5>
                                </div>
                                <div class="col-sm-4 text-right">
                                    <!-- users can only manipulate the data they created -->
                                    <!-- if(!Auth::guest() && Auth::user()->id == $carousel->user_id) -->
                                    {!! Form::open(['action' => ['DashboardController@destroy', $post->id],'method' => 'POST']) !!}
                                        @method('DELETE')
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a title="View" href="/dashboard/{{$post->id}}" class="btn btn-primary btn-sm"><i class="far fa-eye"></i></a>
                                            <a title="Update" href="/dashboard/{{$post->id}}/edit" class="btn btn-secondary btn-sm"><i class="far fa-edit"></i></a>
                                            @if(App\Post::is_delete($post->id))
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Delete data?')"><i class="fas fa-eraser"></i></button>
                                            @endif
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <hr>
                            <small>Last update by {{$post->user->name}} at {{date("d M Y H:i:s",strtotime($post->updated_at))}}</small>
                        </div>
                    </div>
                @endforeach
                {{$posts->links()}}
            @endif

    </div>
</div>
@endsection
