<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Food;
use App\Order;
use App\Profile;
use App\Company;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'district', 'subdistrict' ,'phone'
    ];

    /**
     *Ni nak bgtahu user ada bnayak roles ( Many to Many)
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function food(){
        return $this->hasMany(Food::class);
    }

    public function company(){
      return $this->hasOne(Company::class);
  }

    public function pesanans(){
      return $this->hasMany(Pesanan::class);
    }

    public function pivots(){

      return $this->belongsToMany(Food::class, 'pivots');

    }

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function review(){
        return $this->hasMany(Review::class);
    }

    public function likes(){
      return $this->belongsToMany(Profile::class, 'likes');
    }

    public function alreadyLiked(Profile $profile){
      return $profile->liked->contains('user_id', $this->id);
    }

    public function orders() {
      return $this->hasMany(Order::class);
    }

    public function bought(){
      return $this->hasMany(Bought::class);
    }
}
