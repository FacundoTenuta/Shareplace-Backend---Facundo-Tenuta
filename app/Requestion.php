<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requestion extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    Protected $fillable=[
    'title',
    'fromDate',
    'untilDate',
    'reason',
    'state',
    'active',
    'isLoan',
    'startDate',
    'endDate',
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
