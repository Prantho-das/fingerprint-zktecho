<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = [];

    public function user(){
           return $this->hasOne('App\Models\User','id','user_id',);
    }
    
}
