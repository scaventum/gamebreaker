<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carousel;
use App\Configuration;

class PagesController extends Controller
{
    public function index(){
        $carousels =  Carousel::orderBy('position','asc')->where('activity',1)->get();
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
            "header" => Configuration::where("key","GAMES_TITLE")->first()->value,
            "subheader" => Configuration::where("key","GAMES_SUBTITLE")->first()->value,
            "img_header" => Configuration::where("key","GAMES_IMG")->first()->value,
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
            "header" => Configuration::where("key","ABOUT_TITLE")->first()->value,
            "subheader" => Configuration::where("key","ABOUT_SUBTITLE")->first()->value,
            "img_header" => Configuration::where("key","ABOUT_IMG")->first()->value,
        );
        return view("pages.about")->with($data);
    }
}
