@extends('layouts.app')

@section('content')
    @include('inc.header')
    <section class="content">
        <div class="container">
            {!! $content !!}
        </div>
    </section>
@endsection
