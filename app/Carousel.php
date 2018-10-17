<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Carousel extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public static function sort($request){
        DB::beginTransaction();

        DB::table('carousels')
            ->update([
                'position' => 0,
                'activity' => 0,
                'user_id' => Auth::user()->id,
                'updated_at' => now()
            ]);

        for($i=0;$i<count($request["id_active"]);$i++){
            echo($request["id_active"][$i]." - ".$i."<br>");
            DB::table('carousels')
                ->where('id', $request["id_active"][$i])
                ->update([
                    'position' => $i+1,
                    'activity' => 1,
                    'user_id' => Auth::user()->id,
                    'updated_at' => now()
                ]);
        }

        DB::commit();
    }

    public static function is_delete($id){
        $result=true;

        $carousel_active = Carousel::where([
            'activity' => 1, 
            'id' => $id
        ])->get();
        
        // $carousel_active = DB::table('carousels')
        //     ->where('id', $id)
        //     ->where('activity', 1)->first(); 
        if(count($carousel_active)>0){
            $result=false;
        }

        return $result;
    }
}
