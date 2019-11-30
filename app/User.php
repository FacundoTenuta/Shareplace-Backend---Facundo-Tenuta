<?php

namespace App;

use App\Ability;
use App\Link;
use App\Publication;
use App\Requestion;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    // Segun un profe de youtube indica que usar constantes de tipo string es mas eficiente que usar un tipo booleando en el atributo "enabled" y "admin", vemos si nos sirve en un futuro

    // const USER_ENABLED = '1';
    // const USER_DISABLED ='0';

    // const USER_ADMIN = 'true';
    // const USER_REGULAR = 'false';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastName',
        'email',
        'password',
        'dni',
        'birthDate',
        'admin',
        'enabled',
        'image',
        'description',
    ];

    public function setEmailAttribute($valor){
        $this->attributes['email'] = strtolower($valor);
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // *
    //  * The attributes that should be cast to native types.
    //  *
    //  * @var array
     
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];


    //Funcion que establece la relacion "un usuario tiene muchas publicaciones"
    public function publications(){
        return $this->hasMany(Publication::class);
    }

    //Funcion que establece la relacion "un usuario tiene muchas solicitudes"
    public function requests(){
        return $this->hasMany(Requestion::class);
    }

    public function links(){
        return $this->hasMany(Link::class);
    }

    public function abilities(){
        return $this->belongsToMany(Ability::class);
    }


    //Funcion que retorna "true" si un usuario es administrador, en caso contrario retorna "false"
    // public function isAdmin(){
    //     return $this->admin == User::USER_ADMIN;
    // }


    //Funcion que retorna "true" si un usuario esta habilitado, en caso contrario retorna "false"
    // public function isEnabled(){
    //     return $this->enabled == User::USER_ENABLED;
    // }



    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
