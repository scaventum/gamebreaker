<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Game;
use App\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->head_icon = "<i class='fas fa-desktop'></i>";
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $posts = $user->posts()->orderBy('updated_at','desc')->paginate(10);

        $data = array(
            "title" => "Dashboard",
            "header" => "Dashboard",
            "head_icon" => $this->head_icon,
            "subheader" => "Dashboard",
            "posts" => $posts
        );
        return view('dashboard.index')->with($data);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $games = Game::orderBy("name","asc")->pluck('name', 'id')->toArray();
        $request->user()->authorizeRoles(['ADMIN']);
        $data = array(
            "title" => "Posts - Create",
            "header" => "Posts - Create",
            "head_icon" => $this->head_icon,
            "subheader" => "Create posts content on Home page",
            "games" => $games
        );
        return view('dashboard.create')->with($data);
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
            "title" => "required",
            "description" => "required",
            "video" => "mimes:mp4,mov,ogg,qt|max:19999|required",
            "game_id" => "required"
        ]);

        $post = new Post();
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->game_id = $request->input('game_id');
        $post->user_id = auth()->user()->id;
        $post->video = "";
        $post->save();

        if($request->hasFile('video')){
            $filenameExt = $request->file("video")->getClientOriginalName();
            $filename = pathinfo($filenameExt, PATHINFO_FILENAME);
            $extension = $request->file("video")->getClientOriginalExtension();
            $filenameFinal = $filename.".".$extension;
            $path = $request->file("video")->storeAs("public/vid/posts/".$post->id.'/',$filenameFinal);
        }

        $post->video = $filenameFinal;
        $post->save();
        
        return redirect('/dashboard')->with('success','Post is successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $post = Post::find($id);
        if(!$post || $post->user_id != auth()->user()->id) return redirect('/dashboard')->with('error','Request is invalid.');

        $data = array(
            "title" => "Posts - View ".$post->id,
            "header" => "Posts - View ".$post->id,
            "head_icon" => "<i class='fas fa-film'></i>",
            "subheader" => "Show posts content on Home page",
            "post" => $post
        );
        return view('dashboard.show')->with($data);
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
        $post = Post::find($id);

        if(!$post || $post->user_id != auth()->user()->id) return redirect('/dashboard')->with('error','Request is invalid.');
        $games = Game::orderBy("name","asc")->pluck('name', 'id')->toArray();
        
        $data = array(
            "title" => "Posts - Update ".$post->id,
            "header" => "Posts - Update ".$post->id,
            "head_icon" => $this->head_icon,
            "subheader" => "Update posts content on Home page",
            "post" => $post,
            "games" => $games
        );
        return view('dashboard.edit')->with($data);
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
        $post = Post::find($id);
        if(!$post || $post->user_id != auth()->user()->id) return redirect('/dashboard')->with('error','Request is invalid.');

        $this->validate($request, [
            "title" => "required",
            "description" => "required",
            "video" => "mimes:mp4,mov,ogg,qt|max:19999|nullable",
            "game_id" => "required"
        ]);

        if($request->hasFile('video')){
            $filenameExt = $request->file("video")->getClientOriginalName();
            $filename = pathinfo($filenameExt, PATHINFO_FILENAME);
            $extension = $request->file("video")->getClientOriginalExtension();
            $filenameFinal = $filename.".".$extension;
            Storage::delete('public/vid/posts/'.$post->id.'/'.$post->video);
            $path = $request->file("video")->storeAs("public/vid/posts/".$post->id.'/',$filenameFinal);
        }

        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->game_id = $request->input('game_id');
        if($request->hasFile('video')){
            $post->video = $filenameFinal;
        }
        $post->user_id = auth()->user()->id;
        $post->updated_at = now();
        $post->save();
        
        return redirect('/dashboard/'.$id)->with('success','Post is successfully updated.');
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

        $post = Post::find($id);
        $is_delete = Post::is_delete($id);

        if(!$post) $transaction = false;
        if(!$is_delete) $transaction = false;
        if($post->user_id != auth()->user()->id) $transaction = false;
        
        if(!$transaction) return redirect('/dashboard')->with('error','Request is invalid.');

        Storage::delete('public/vid/posts/'.$post->id.'/'.$post->video);
        $post->delete();
        
        return redirect('/dashboard')->with('success','Post is successfully deleted.');
    }
}
