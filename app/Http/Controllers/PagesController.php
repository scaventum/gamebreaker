<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Carousel;
use App\Game;
use App\Configuration;

class PagesController extends Controller
{
    public function index(Request $request){
        $keyword = '';
        $game_id = array();

        $carousels =  Carousel::orderBy('position','asc')->where('activity',1)->get();
        $games =  Game::orderBy('name','asc')->where('activity',1)->get();
        $posts =  Post::orderBy('updated_at','desc');

        if ($request->isMethod('post')) {
            $keyword = $request["keyword"];
            $game_id = $request["game_id"];
            
            if($game_id==Null) $game_id=array();
            $posts->whereIn('game_id', $game_id);

            $posts = $posts->where(function($query) use ($request) {
                $query
                    ->where('title','like','%'.$request['keyword'].'%')
                    ->orWhere('description','like','%'.$request['keyword'].'%')
                    ->orWhereHas('user', function($query) use ($request) {
                        $query->where('name','like','%'.$request['keyword'].'%');
                    });
            });
        }else{
            $game_id=Game::orderBy("name","asc")->pluck('id')->toArray();
        }

        $posts = $posts->paginate(8);

        $data = array(
            "title" => "Home",
            "posts" => $posts,
            "games" => $games,
            "carousel" => array(
                "interval" => 3000,
                "carousel_items" => $carousels
            ),
            "filter" => array(
                "keyword" => $keyword,
                "game_id" => $game_id
            ),
        );
        return view("pages.index")->with($data);
    }

    public function like_post(Request $request){

        $this->middleware('auth');

        if ($request->isMethod('post')) {
            Post::like_post($request);
            return response()->json(['success'=>'']);
        }
                
        return response()->json(['error'=>'Request is invalid.']);
    }

    public function games(){
        $games =  Game::orderBy('name','asc')->where('activity',1)->get();
        $data = array(
            "title" => "Games",
            "header" => Configuration::find(1)->games_title,
            "subheader" => Configuration::find(1)->games_subtitle,
            "img_header" => "games.png",
            "games" => $games
        );
        return view("pages.games")->with($data);
    }

    public function about(){
        $data = array(
            "title" => "About",
            "header" => Configuration::find(1)->about_title,
            "subheader" => Configuration::find(1)->about_subtitle,
            "img_header" => "about.png",
            "content" => Configuration::find(1)->about_content
        );
        return view("pages.about")->with($data);
    }
}
