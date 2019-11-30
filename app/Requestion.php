<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requestion extends Model
{
    Protected $fillable=[
    'title',
    'fromDate',
    'untilDate',
    'reason',
    'state',
    'publication_id',
    'requester_id',
    ];

    //Funcion que establece la relacion "una solicitud pertenece a una publicación"
    public function publication(){
    	return $this->belongsTo(Publication::class);
    }

    //Funcion que establece la relacion "una solicitud pertenece a un solicitante"
    public function requester(){
    	return $this->belongsTo(User::class);
    }
}
