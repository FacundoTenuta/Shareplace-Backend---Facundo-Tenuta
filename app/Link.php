<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];

    Protected $fillable=[
    'name',
    ];


    public function user(){
    	return $this->belongsTo(User::class);
    }
}
