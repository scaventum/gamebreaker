<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carousel;

class CarouselsController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->head_icon = "<i class='far fa-images'></i>";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            "title" => "Carousels",
            "header" => "Carousels",
            "head_icon" => $this->head_icon,
            "subheader" => "Maintain carousels content on Home page",
            "carousels" => Carousel::orderBy('activity','desc')->orderBy('position', 'asc')->paginate(10)
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
        ]);

        $carousel = new Carousel();
        $carousel->caption = $request->input('caption');
        $carousel->subcaption = $request->input('subcaption');
        $carousel->img = '';
        $carousel->position = ($request->input('activity')==1?Carousel::max('position')+1:0);
        $carousel->activity = 0;
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
            "subcaption" => "required",
        ]);

        $carousel->caption = $request->input('caption');
        $carousel->subcaption = $request->input('subcaption');
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
        $carousel->delete();
        
        return redirect('/carousels')->with('success','Carousel is successfully deleted.');
    }

    //Sort, activate and deactivate
    public function sort()
    {
        //
    }
}
