<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public static function is_delete($id){
        $result=true;

        $game_active = Post::where([
            'game_id' => $id
        ])->get();
        
        if(count($game_active)>0){
            $result=false;
        }

        return $result;
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }
}
