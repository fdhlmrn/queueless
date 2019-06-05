<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use DB;


class Food extends Model
{
    //
    use Notifiable;

    protected $fillable = [
      'nama_makanan', 'saiz_hidangan', 'harga', 
    ];


    public function user(){
      return $this->belongsTo(User::class);
    }

    public function pivots(){
      return $this->belongsToMany(User::class, 'pivots');
    }

    public function cartDetail(){
      return $this->hasMany(CartDetail::class,'food_id');
    }

    public function bought(){
      return $this->belongsToMany(Bought::class,'food_id');
    }

    public static function getByDistance($lat, $lng, $distance)
{
  $results = DB::select(DB::raw('SELECT id,nama_makanan, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $lng . ') ) + sin( radians(' . $lat .') ) * sin( radians(latitude) ) ) ) AS distance FROM foods HAVING distance < ' . $distance . ' ORDER BY distance') );

  return $results;
}

}
