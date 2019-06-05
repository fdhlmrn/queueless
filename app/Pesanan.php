<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
      'nama_makanan', 'saiz_hidangan', 'harga'
    ];

    public function user(){
      return $this->belongsTo(User::class);
    }

}
