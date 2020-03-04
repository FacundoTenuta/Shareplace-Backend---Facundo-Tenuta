<?php

namespace App;

use App\Category;
use App\Condition;
use App\Image;
use App\Requestion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publication extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    Protected $fillable=[
    'title',
    'description',
    'createDate',
    'state',
    'user_id',
    'principalImage',
    ];

    //Funcion que establece la relacion "una publicación pertenece a un usuario"
    public function user(){
    	return $this->belongsTo(User::class);
    }

	//Funcion que establece la relacion "una publicacion tiene muchas solicitudes"
    public function requests(){
    	return $this->hasMany(Requestion::class);
    }

    //Funcion que establece la relacion "una publicacion tiene muchas imagenes"
    public function images(){
    	return $this->hasMany(Image::class);
    }

    public function conditions(){
        return $this->belongsToMany(Condition::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
