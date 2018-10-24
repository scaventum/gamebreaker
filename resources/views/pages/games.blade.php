@extends('layouts.app')

@section('content')
    @include('inc.header')
    <section class="content">
        <div class="container">
            @if(count($games)>0)
                @foreach($games as $game)
                    <div class="page-content-list">
                        <div class="row">
                            <div class="col-md-4 image" 
                            style="background:url({{asset('storage/img/games/'.$game->id.'/'.$game->img)}}) center center no-repeat;background-size:cover;">
                            </div>
                            <div class="col-md-8 p-lg-5 p-3 description">
                                <h3>
                                    <img src="{{asset('storage/img/games/'.$game->id.'/'.$game->logo)}}" height="30" class="d-inline-block" alt="">
                                    {!! $game->name !!}
                                </h3>
                                <div class="text-justify">
                                    {!! $game->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
@endsection