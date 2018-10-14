<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Carousel;
use App\User;

class CarouselsController extends Controller
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
        $this->head_icon = "<i class='far fa-images'></i>";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user_id = auth()->user()->id;
        // $user = User::find($user_id);
        // $carousels = $user->carousels()->orderBy('activity','desc')->orderBy('position', 'asc')->paginate(10);
        
        $carousels = Carousel::orderBy('activity','desc')->orderBy('position', 'asc')->paginate(10);

        $data = array(
            "title" => "Carousels",
            "header" => "Carousels",
            "head_icon" => $this->head_icon,
            "subheader" => "Maintain carousels content on Home page",
            "carousels" => $carousels
        );
        return view('carousels.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            "title" => "Carousels - Create",
            "header" => "Carousels - Create",
            "head_icon" => $this->head_icon,
            "subheader" => "Create carousels content on Home page"
        );
        return view('carousels.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "caption" => "required",
            "subcaption" => "required",
            "img" => "image|max:1999|required"
        ]);

        if($request->hasFile('img')){
            //filename with ext
            $filenameExt = $request->file("img")->getClientOriginalName();

            //filename
            $filename = pathinfo($filenameExt, PATHINFO_FILENAME);

            //ext
            $extension = $request->file("img")->getClientOriginalExtension();

            //filename final, can be customed with strings
            $filenameFinal = $filename.".".$extension;

            //upload image
            $path = $request->file("img")->storeAs("public/img/carousels",$filenameFinal);

        }

        $carousel = new Carousel();
        $carousel->caption = $request->input('caption');
        $carousel->subcaption = $request->input('subcaption');
        $carousel->img = $filenameFinal;
        $carousel->position = 0;
        $carousel->activity = 0;
        $carousel->user_id = auth()->user()->id;
        $carousel->save();
        
        return redirect('/carousels')->with('success','Carousel is successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carousel = Carousel::find($id);
        if(!$carousel) return redirect('/carousels')->with('error','Request is invalid.');

        $data = array(
            "title" => "Carousel - ".$carousel->id,
            "header" => "Carousel - ".$carousel->id,
            "head_icon" => $this->head_icon,
            "subheader" => "Maintain carousels content on Home page",
            "carousel" => $carousel
        );
        return view('carousels.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carousel = Carousel::find($id);

        if(!$carousel) return redirect('/carousels')->with('error','Request is invalid.');

        //users can only manipulate the data they created
        //if($carousel->user_id != auth()->user()->id) return redirect('/carousels')->with('error','Request is invalid.');
        
        $data = array(
            "title" => "Carousel - ".$carousel->id,
            "header" => "Carousel - ".$carousel->id,
            "head_icon" => $this->head_icon,
            "subheader" => "Maintain carousels content on Home page",
            "carousel" => $carousel
        );
        return view('carousels.edit')->with($data);
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
        $carousel = Carousel::find($id);
        if(!$carousel) return redirect('/carousels')->with('error','Request is invalid.');

        $this->validate($request, [
            "caption" => "required",
            "subcaption" => "required"
        ]);

        if($request->hasFile('img')){
            //filename with ext
            $filenameExt = $request->file("img")->getClientOriginalName();

            //filename
            $filename = pathinfo($filenameExt, PATHINFO_FILENAME);

            //ext
            $extension = $request->file("img")->getClientOriginalExtension();

            //filename final, can be customed with strings
            $filenameFinal = $filename.".".$extension;

            //upload image
            Storage::delete('public/img/carousels/'.$carousel->img);
            $path = $request->file("img")->storeAs("public/img/carousels",$filenameFinal);
        }

        $carousel->caption = $request->input('caption');
        $carousel->subcaption = $request->input('subcaption');
        if($request->hasFile('img')){
            $carousel->img = $filenameFinal;
        }
        $carousel->user_id = auth()->user()->id;
        $carousel->updated_at = now();
        $carousel->save();
        
        return redirect('/carousels/'.$id)->with('success','Carousel is successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carousel = Carousel::find($id);
        if(!$carousel) return redirect('/carousels')->with('error','Request is invalid.');
        //users can only manipulate the data they created
        //if($carousel->user_id != auth()->user()->id) return redirect('/carousels')->with('error','Request is invalid.');

        Storage::delete('public/img/carousels/'.$carousel->img);
        $carousel->delete();
        
        return redirect('/carousels')->with('success','Carousel is successfully deleted.');
    }

    //Sort, activate and deactivate
    public function sort()
    {
        //
    }
}
