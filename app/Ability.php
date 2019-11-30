<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    Protected $fillable=[
    'name',
    ];


    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function setNameAttribute($valor){
        $this->attributes['name'] = strtolower($valor);
    }

    public function getNameAttribute($valor){
        return ucfirst($valor);
    }
}
