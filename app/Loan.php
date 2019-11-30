<?php

namespace App;

use App\Requestion;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    Protected $fillable=[
    'startDate',
    'endDate',
    'requestion_id',
    ];

    //Funcion que establece la relacion "una solicitud pertenece a un prestamo"
    public function requestion(){
    	return $this->belongsTo(Requestion::class);
    }
}
