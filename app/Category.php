<?php

namespace App;

use App\Publication;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    Protected $fillable=[
    'name',
    ];


    public function publications(){
        return $this->belongsToMany(Publication::class);
    }

}
