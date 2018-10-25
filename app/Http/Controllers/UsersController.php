<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request)
    {   
        
        $user = Auth::user();

        if ($request->isMethod('put')) {
            $this->validate($request, [
                "name" => "required",
                "avatar" => "image|max:1999|nullable"
            ]);

            if($request->hasFile('avatar')){
                $filenameFinal = $user->id.".png";
                Storage::delete('public/img/avatars/'.$user->id.".png");
                $path = $request->file("avatar")->storeAs("public/img/avatars",$filenameFinal);
            }

            $user->name = $request->input('name');
            $user->save();
            return redirect('/profile')->with('success','Profile is successfully updated.');
        }


        $data = array(
            "title" => "Profile",
            "header" => "Profile",
            "head_icon" => $this->head_icon,
            "subheader" => "Maintain users profile",
            "user" => $user
        );
        return view('users.profile')->with($data);
    }

    // Display a listing of the users from ajax.
    public function select_users(Request $request)
    {
        $request->user()->authorizeRoles(['ADMIN']);

        $users = User::all();
        $roles = Role::all();
        
        foreach ($users as $key => $value){

            $role = "";
            if($value->roles[0]->id!=1){
                $role = ' <select id="role_id" name="role_id" class="form-control" data-id="'.$value->id.'">';
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

    //update role of the user from ajax.
    public function update_role(Request $request)
    {
        $request->user()->authorizeRoles(['ADMIN']);

        if ($request->isMethod('post')) {

            Role::update_role($request);
            return response()->json(['success'=>'Successfully updated the role of user #'.$request->input('id').'.']);
        }
                
        return response()->json(['error'=>'Request is invalid.']);
    }
}
