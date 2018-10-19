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
            "header" => Configuration::find(1)->games_title,
            "subheader" => Configuration::find(1)->games_subtitle,
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
            "header" => Configuration::find(1)->about_title,
            "subheader" => Configuration::find(1)->about_subtitle,
            "img_header" => "about.png",
        );
        return view("pages.about")->with($data);
    }
}
