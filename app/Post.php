<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
