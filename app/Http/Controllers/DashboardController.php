<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $data = array(
            "title" => "Dashboard",
            "header" => "Dashboard",
            "head_icon" => $this->head_icon,
            "subheader" => "Dashboard"
        );
        return view('dashboard.index')->with($data);
    }
}
