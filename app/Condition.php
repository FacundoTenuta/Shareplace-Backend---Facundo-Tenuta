<?php

namespace App;

use App\Publication;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    //
    Protected $fillable=[
    'name',
    ];

    public function publications(){
    	return $this->belongsToMany(Publication::class);
    }

    public function setNameAttribute($valor){
        $this->attributes['name'] = strtolower($valor);
    }

    public function getNameAttribute($valor){
        return ucfirst($valor);
    }
}
