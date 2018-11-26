<?php

namespace App\Http\Controllers;

use App\Game;
use App\Http\Resources\Game as GameResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GamesController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',[
            'except' => [
                'api_list'
            ]
        ]);
        //$this->middleware('auth');
        $this->head_icon = "<i class='fas fa-gamepad'></i>";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['ADMIN']);
        
        $games = Game::orderBy('name','asc')->paginate(10);

        $data = array(
            "title" => "Games",
            "header" => "Games",
            "head_icon" => $this->head_icon,
            "subheader" => "Maintain games content",
            "games" => $games
        );
        return view('games.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['ADMIN']);
        $data = array(
            "title" => "Games - Create",
            "header" => "Games - Create",
            "head_icon" => $this->head_icon,
            "subheader" => "Create games content"
        );
        return view('games.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['ADMIN']);
        $this->validate($request, [
            "name" => "required",
            "description" => "required",
            "img" => "image|max:1999|required",
            "logo" => "image|max:1999|required"
        ]);

        $game = new Game();
        $game->name = $request->input('name');
        $game->description = $request->input('description');
        $game->img = '';
        $game->logo = '';
        $game->activity = ($request->input('activity')==1?1:0);
        $game->user_id = auth()->user()->id;
        $game->save();

        if($request->hasFile('img')){
            $filenameExt = $request->file("img")->getClientOriginalName();
            $filename = pathinfo($filenameExt, PATHINFO_FILENAME);
            $extension = $request->file("img")->getClientOriginalExtension();
            $filenameFinalImage = $filename."_img.".$extension;
            $path = $request->file("img")->storeAs("public/img/games/".$game->id."/",$filenameFinalImage);
        }

        if($request->hasFile('logo')){
            $filenameExt = $request->file("logo")->getClientOriginalName();
            $filename = pathinfo($filenameExt, PATHINFO_FILENAME);
            $extension = $request->file("logo")->getClientOriginalExtension();
            $filenameFinalLogo = $filename."_logo.".$extension;
            $path = $request->file("logo")->storeAs("public/img/games/".$game->id."/",$filenameFinalLogo);
        }

        $game->img = $filenameFinalImage;
        $game->logo = $filenameFinalLogo;
        $game->save();
        
        return redirect('/games')->with('success','Game is successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $request->user()->authorizeRoles(['ADMIN']);
        $game = Game::find($id);
        if(!$game) return redirect('/games')->with('error','Request is invalid.');

        $data = array(
            "title" => "Games - View ".$game->id,
            "header" => "Games - View ".$game->id,
            "head_icon" => $this->head_icon,
            "subheader" => "Show games content",
            "game" => $game
        );
        return view('games.show')->with($data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRoles(['ADMIN']);
        $game = Game::find($id);

        if(!$game) return redirect('/games')->with('error','Request is invalid.');

        //users can only manipulate the data they created
        //if($carousel->user_id != auth()->user()->id) return redirect('/carousels')->with('error','Request is invalid.');
        
        $data = array(
            "title" => "Games - Update ".$game->id,
            "header" => "Games - Update ".$game->id,
            "head_icon" => $this->head_icon,
            "subheader" => "Update games content",
            "game" => $game
        );
        return view('games.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->user()->authorizeRoles(['ADMIN']);
        $game = Game::find($id);
        if(!$game) return redirect('/games')->with('error','Request is invalid.');

        $this->validate($request, [
            "name" => "required",
            "description" => "required",
            "img" => "image|max:1999",
            "logo" => "image|max:1999"
        ]);

        if($request->hasFile('img')){
            $filenameExt = $request->file("img")->getClientOriginalName();
            $filename = pathinfo($filenameExt, PATHINFO_FILENAME);
            $extension = $request->file("img")->getClientOriginalExtension();
            $filenameFinalImage = $filename."_img.".$extension;

            Storage::delete("public/img/games/".$game->id."/",$game->img);
            $path = $request->file("img")->storeAs("public/img/games/".$game->id."/",$filenameFinalImage);
        }

        if($request->hasFile('logo')){
            $filenameExt = $request->file("logo")->getClientOriginalName();
            $filename = pathinfo($filenameExt, PATHINFO_FILENAME);
            $extension = $request->file("logo")->getClientOriginalExtension();
            $filenameFinalLogo = $filename."_logo.".$extension;

            Storage::delete("public/img/games/".$game->id."/",$game->logo);
            $path = $request->file("logo")->storeAs("public/img/games/".$game->id."/",$filenameFinalLogo);
        }

        $game->name = $request->input('name');
        $game->description = $request->input('description');
        if($request->hasFile('img')) $game->img = $filenameFinalImage;
        if($request->hasFile('logo')) $game->logo = $filenameFinalLogo;
        $game->activity = ($request->input('activity')==1?1:0);
        $game->user_id = auth()->user()->id;
        $game->save();
        
        return redirect('/games/'.$id)->with('success','Game is successfully updated.');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRoles(['ADMIN']);
        $transaction=true;

        $game = Game::find($id);
        $is_delete = Game::is_delete($id);

        if(!$game) $transaction = false;
        if(!$is_delete) $transaction = false;
        
        if(!$transaction) return redirect('/games')->with('error','Request is invalid.');

        Storage::delete('public/img/games/'.$game->id."/".$game->img);
        Storage::delete('public/img/games/'.$game->id."/".$game->logo);
        Storage::delete('public/img/games/'.$game->id);
        $game->delete();
        
        return redirect('/games')->with('success','Game is successfully deleted.');
    }

    /* API */

    //Return API games list
    public function api_list($item_per_page = 0)
    {
        $games = Game::where('activity',1)->paginate($item_per_page);
        return GameResource::collection($games);
    }
}
