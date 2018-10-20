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

    /**
     * Display a listing of the resource from ajax.
     *
     * @return \Illuminate\Http\Response
     */
    public function select_users(Request $request)
    {
        $users = User::all();
        $roles = Role::all();
        
        foreach ($users as $key => $value){

            $role = "";
            if($value->roles[0]->id!=1){
                $role = ' <select id="role_id" name="role_id" class="form-control">';
                foreach($roles as $value_role){
                    $role .= ' <option value="'.$value_role->id.'" '.($value->roles[0]->id==$value_role->id?"selected":"").'>'.$value_role->name.'</option>';
                }
                $role .= '</select>';
            }else{
                $role = $value->roles[0]->name;
            }
            $value->role = $role;
        }

        echo(json_encode(array("data"=>$users)));
    }
}
