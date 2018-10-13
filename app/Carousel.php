<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
}
