<?php

namespace App;

use App\Publication;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Condition extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
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
