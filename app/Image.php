<?php

namespace App;

use App\Publication;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
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
