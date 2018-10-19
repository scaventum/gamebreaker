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

        // $carousel_active = Carousel::where([
        //     'activity' => 1, 
        //     'id' => $id
        // ])->get();
        
        // if(count($carousel_active)>0){
        //     $result=false;
        // }

        return $result;
    }
}
