<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $fillable = [
    	'id', 'address', 'phone', 'state', 'district', 'subdistrict'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function review(){
    	return $this->hasMany(Review::class);
    }

    public function likes(){
        return $this->belongsToMany(User::class, 'likes');
    }

    public function liked(){
        return $this->hasMany(Like::class, 'profile_id');
    }


}
