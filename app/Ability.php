<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ability extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

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
