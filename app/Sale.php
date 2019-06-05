<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //



    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function foods(){
        return $this->hasMany(Makanan::class);
    }

}
