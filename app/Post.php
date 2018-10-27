<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class Post extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function game(){
        return $this->belongsTo('App\Game');
    }

    public static function is_delete($id){
        $result=true;
        return $result;
    }

    public static function get_like($post_id){
        $result = DB::table('post_like')
            ->where('post_like.post_id', $post_id)
            ->count();

        return $result;
    }
    
    public static function is_user_like($post_id,$user_id){
        $result = DB::table('post_like')
            ->where('post_like.post_id', $post_id)
            ->where('post_like.user_id', $user_id)
            ->exists();

        return $result;
    }
}
