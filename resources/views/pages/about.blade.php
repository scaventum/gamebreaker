@extends('layouts.app')

@section('content')
    @include('inc.header')
    <section class="content">
        <div class="container">
            {!! $content !!}

            <div id="like_button_container"></div>

            <script src="{{asset('js/like_button.js')}}"></script>

        </div>
    </section>
@endsection
