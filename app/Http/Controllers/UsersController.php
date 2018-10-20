<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class UsersController extends Controller
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
        $this->head_icon = "<i class='far fa-user'></i>";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['ADMIN']);
        
        $users = User::all();
        $roles = Role::all();

        $data = array(
            "title" => "Users",
            "header" => "Users",
            "head_icon" => $this->head_icon,
            "subheader" => "Maintain users content",
            "users" => $users,
            "roles" => $roles
        );
        return view('users.index')->with($data);
    }
}
