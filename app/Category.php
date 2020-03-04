<?php

namespace App;

use App\Publication;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];

    Protected $fillable=[
    'name',
    ];


    public function publications(){
        return $this->belongsToMany(Publication::class);
    }

}
