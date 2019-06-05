<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bought extends Model
{
    protected $fillable = [
      'seller_id', 'buyer_id', 'food_id','quantity','totalPrice', 
    ];

    public function user(){
    	return $this->belongsTo(User::class, 'seller_id');
    }

    public function user2(){
    	return $this->belongsTo(User::class, 'buyer_id');
    }

    public function food(){
    	return $this->belongsTo(Food::class);
    }
}
