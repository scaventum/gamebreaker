<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carousel;

class PagesController extends Controller
{
    public function index(){
        $carousels =  Carousel::orderBy('position','asc')->get();
        $data = array(
            "title" => "Home",
            "carousel" => array(
                "interval" => 3000,
                "carousel_items" => $carousels
            )
        );
        return view("pages.index")->with($data);
    }

    public function games(){
        $data = array(
            "title" => "Games",
            "header" => "All the Games in the World",
            "subheader" => "From peaceful backyard to the depths of hell",
            "img_header" => "games.png",
            "games" => array(
                "DOTA 2",
                "StarCraft 2",
                "Counter Strike: Global Offensive"
            )
        );
        return view("pages.games")->with($data);
    }

    public function about(){
        $data = array(
            "title" => "About",
            "header" => "Starting from the Bottom ...",
            "subheader" => "... and here we are",
            "img_header" => "about.png"
        );
        return view("pages.about")->with($data);
    }
}
