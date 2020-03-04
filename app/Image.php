<?php

namespace App;

use App\Publication;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'date',
        'publication_id',
        'path',
    ];

    //Funcion que establece la relacion "una imagen pertenece a una publicación"
    public function publication(){
    	return $this->belongsTo(Publication::class);
    }
}
