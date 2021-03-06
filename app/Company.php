<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_name', 'company_contact'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
