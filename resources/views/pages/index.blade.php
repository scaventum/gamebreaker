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

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                    @if(count($posts)>0)
                        @foreach($posts as $post)
                            <div class="col-lg-6 p-1">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <video class="embed-responsive-item" controls>
                                        <source src="{{asset('storage/vid/posts/'.$post->id.'/'.$post->video)}}" >
                                    </video>
                                </div>
                                <div class="post-content">
                                    <h5>
                                        <img src="{{asset('storage/img/games/'.$post->game->id.'/'.$post->game->logo)}}" height="30" class="d-inline-block" alt="">
                                        {{$post->title}}
                                    </h5>
                                    <small>By {{$post->user->name}} at {{date("d M Y H:i",strtotime($post->updated_at))}}</small>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    </div>
                    <div class="row">
                        {{$posts->links()}}
                    </div>
                </div>
                <div class="col-lg-3 p-1">
                    <div class="post-filter">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    $(document).ready(function(){

        $('.carousel').carousel({
            interval: {{$carousel['interval']}}
        });
        
    });
    </script>
    
@endsection