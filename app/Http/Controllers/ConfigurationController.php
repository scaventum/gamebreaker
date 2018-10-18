<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        $data = array(
            "title" => "Configuration",
            "header" => "Configuration",
            "head_icon" => $this->head_icon,
            "subheader" => "Maintain website configuration"
        );
        return view('configuration.index')->with($data);
    }
}
