@extends('layouts.app')

@section('content')


@if(count($carousel['carousel_items'])>0)
<div id="home-carousel" class="carousel slide">
        <ol class="carousel-indicators">
            @foreach($carousel['carousel_items'] as $carousel_item )
            <li data-target="#home-carousel" data-slide-to="{{$carousel_item['position']-1}}" class="{{($carousel_item['position']-1==0?'active':'')}}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach($carousel['carousel_items'] as $carousel_item)
                <div class="carousel-item {{($carousel_item['position']-1==0?'active':'')}}">
                    <div class="carousel-image" style="background:url({{asset('storage/img/carousels/'.$carousel_item['img'])}}) center center;background-size:cover;'>"></div>
                    <div class="carousel-caption d-none d-md-block">
                        <div class="container">
                            <h1>{!!$carousel_item['caption']!!}</h1>
                            <p>{!!$carousel_item['subcaption']!!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#home-carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#home-carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
@endif

<script>
$(document).ready(function(){

    $('.carousel').carousel({
        interval: {{$carousel['interval']}}
    });
    
});
</script>
    
@endsection