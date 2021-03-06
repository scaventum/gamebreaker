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
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <h5>
                                                <img src="{{asset('storage/img/games/'.$post->game->id.'/'.$post->game->logo)}}" height="30" class="d-inline-block" alt="">
                                                {{$post->title}}
                                            </h5>
                                        </div>
                                        <div class="col-sm-2 text-right text-secondary">
                                            <span class="post-like-count">{{$post->get_like($post->id)}}</span>
                                            <i class=" 
                                            {{(!Auth::guest() && $post->is_user_like($post->id,Auth::user()->id)?'post-liked text-light fas fa-thumbs-up':'post-like far fa-thumbs-up')}}" data-id ="{{$post->id}}"></i>
                                        </div>
                                    </div>
                                    <small class="text-secondary">
                                        <div class="avatar-15 float-left" style="background:url({{asset('storage/img/avatars/'.$post->user->id.'.png')}}) center center no-repeat;background-size:cover;"></div> 
                                        {{$post->user->name}} at {{date("d M Y H:i",strtotime($post->updated_at))}}
                                    </small>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h5>No post found ...</h5>
                    @endif
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {{$posts->links()}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 p-1">
                    <div class="post-filter">
                        {!! Form::open(['action' => ['PagesController@index'],'method' => 'POST', 'files' => true]) !!}
                            <div class="form-group">
                                {{Form::text('keyword', $filter['keyword'], ['class' => 'form-control bg-dark text-light','placeholder' => 'Keyword'])}}
                            </div>
                            
                            <div class="form-group">
                                <ul class="list-group">
                                    @foreach($games as $game)
                                        <li class="list-group-item" style="background:linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.75)), url({{asset('storage/img/games/'.$game->id.'/'.$game->img)}}) center center no-repeat;background-size:cover;">
                                            <div class="row">
                                                <div class="form-check col-lg-9 col-md-12">
                                                    <input class="form-check-input" type="checkbox" name="game_id[]" value="{{$game->id}}"
                                                    {{ (in_array($game->id,$filter['game_id'])?"checked":"") }}>
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        {{$game->name}}
                                                    </label>
                                                </div>
                                                <div class="col-lg-3 d-none d-lg-inline">
                                                    <img src="{{asset('storage/img/games/'.$game->id.'/'.$game->logo)}}" class="d-inline-block img-fluid" alt="">
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <button id="sub_filter" type="submit" name="sub_filter" class="btn btn-danger btn-block">
                                <i class="fas fa-search"></i> Filter
                            </button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    $(document).ready(function(){

        @if(!Auth::guest())
            $('.post-content').on('click', '.post-like', function(e) {
                var _this = $(this);
                var post_id = $(this).attr('data-id');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "/like-post",
                    data:{
                        post_id:post_id,
                        action:"like"
                    },

                    success: function(response) {
                        if($.isEmptyObject(response.error)){
                            _this.removeClass();
                            _this.addClass("post-liked text-light fas fa-thumbs-up");
                            post_like_count = parseInt(_this.parent().find(".post-like-count").html());
                            _this.parent().find(".post-like-count").html(post_like_count+1);
                        }else{
                            alert(response.error);
                        }
                    }
                }); 
            });

            $('.post-content').on('click', '.post-liked', function(e) {
                var _this = $(this);
                var post_id = $(this).attr('data-id');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "/like-post",
                    data:{
                        post_id:post_id,
                        action:"unlike"
                    },

                    success: function(response) {
                        if($.isEmptyObject(response.error)){
                            _this.removeClass();
                            _this.addClass("post-like far fa-thumbs-up");
                            post_like_count = parseInt(_this.parent().find(".post-like-count").html());
                            _this.parent().find(".post-like-count").html(post_like_count-1);
                        }else{
                            alert(response.error);
                        }
                    }
                }); 
            });
        @endif

        $('.carousel').carousel({
            interval: {{$carousel['interval']}}
        });
        
    });
    </script>
    
@endsection