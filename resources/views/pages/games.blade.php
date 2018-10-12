@extends('layouts.app')

@section('content')
    @include('inc.header')
    <section>
        <div class="container">
            @if(count($games)>0)
                <ul class="list-group">
                @foreach($games as $game)
                    <li class="list-group-item">{{$game}}</li>
                @endforeach
                </ul>
            @endif
        </div>
    </section>
@endsection