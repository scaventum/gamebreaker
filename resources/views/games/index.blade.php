@extends('layouts.app')

@section('content')
    <div class="container" data-aos="fade-down">
        <div class="page-header-admin">
            <div class="row">
                <div class="col-8">
                    <div class="page-header-admin-title" title="{{$subheader}}">{!!$head_icon!!} {{$header}}</div>
                </div>
                <div class="col-4 text-right">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="/games/create" class="btn btn-outline-light" title="Create"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-admin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item">Games</li>
                </ol>
            </nav>

            @if(count($games)>0)
                {{$games->links()}}
                @foreach($games as $game)
                    <div class="card content-list bg-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h5 class="card-title">
                                        <a href="/games/{{$game->id}}">
                                            <img src="{{asset('storage/img/games/'.$game->id.'/'.$game->logo)}}" height="30" class="d-inline-block" alt="">
                                            {{strip_tags($game->name)}}
                                        </a>
                                        {!!($game->activity>0?"<i class='fas fa-toggle-on text-success'></i>":"<i class='fas fa-toggle-off text-danger'></i>")!!}
                                    </h5>
                                </div>
                                <div class="col-sm-4 text-right">
                                    {!! Form::open(['action' => ['GamesController@destroy', $game->id],'method' => 'POST']) !!}
                                        @method('DELETE')
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a title="View" href="/games/{{$game->id}}" class="btn btn-primary btn-sm"><i class="far fa-eye"></i></a>
                                            <a title="Update" href="/games/{{$game->id}}/edit" class="btn btn-secondary btn-sm"><i class="far fa-edit"></i></a>
                                            @if(App\game::is_delete($game->id))
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Delete data?')"><i class="fas fa-eraser"></i></button>
                                            @endif
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <hr>
                            <small>Last update by {{$game->user->name}} at {{date("d M Y H:i:s",strtotime($game->updated_at))}}</small>
                        </div>
                    </div>
                @endforeach
                {{$games->links()}}
            @endif
        </div>
    </div>
@endsection