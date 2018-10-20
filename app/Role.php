<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Role extends Model
{

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public static function update_role($request){
        DB::beginTransaction();

        DB::table('role_user')->where('user_id', $request["id"])->delete();

        DB::table('role_user')->insert(
            [
                'role_id' => $request["role_id"],
                'user_id' => $request["id"]
            ]
        );

        DB::commit();
    }
}
