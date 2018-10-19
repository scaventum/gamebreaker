<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Configuration;

class ConfigurationController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth',['except' => ['index','show']]);
        $this->middleware('auth');
        $this->head_icon = "<i class='fas fa-cogs'></i>";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['ADMIN']);

        $configuration = Configuration::find(1);

        if ($request->isMethod('post')) {
            $this->validate($request, [
                "name" => "required",
                "brand" => "required",
                "logo" => "image|mimes:png|max:1999|nullable",
                "favicon" => "image|mimes:png|max:1999|nullable",
                "about_title" => "required",
                "about_subtitle" => "required",
                "about_img" => "image|mimes:png|max:1999|nullable",
                "about_content" => "required",
                "games_title" => "required",
                "games_subtitle" => "required",
                "games_img" => "image|mimes:png|max:1999|nullable"
            ]);

            if($request->hasFile('logo')){
                Storage::delete('public/img/pages/logo.png');
                $path = $request->file("logo")->storeAs("public/img/pages","logo.png");
            }

            if($request->hasFile('favicon')){
                Storage::delete('public/img/pages/favicon.png');
                $path = $request->file("favicon")->storeAs("public/img/pages","favicon.png");
            }

            if($request->hasFile('about_img')){
                Storage::delete('public/img/pages/about.png');
                $path = $request->file("about_img")->storeAs("public/img/pages","about.png");
            }

            if($request->hasFile('games_img')){
                Storage::delete('public/img/pages/games.png');
                $path = $request->file("games_img")->storeAs("public/img/pages","games.png");
            }

            $configuration->name = $request->input('name');
            $configuration->brand = $request->input('brand');
            $configuration->about_title = $request->input('about_title');
            $configuration->about_subtitle = $request->input('about_subtitle');
            $configuration->about_content = $request->input('about_content');
            $configuration->games_title = $request->input('games_title');
            $configuration->games_subtitle = $request->input('games_subtitle');
            $configuration->updated_at = now();
            $configuration->user_id = auth()->user()->id;
            $configuration->save();

            return redirect('/configuration')->with('success','Configuration is successfully updated.');
        }

        $data = array(
            "title" => "Configuration",
            "header" => "Configuration",
            "head_icon" => $this->head_icon,
            "subheader" => "Maintain website configuration",
            "configuration" => $configuration
        );
        return view('configuration.index')->with($data);
    }
}
