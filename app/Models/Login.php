<?php

namespace App\Models;
use DB;
use Request;
 use Laravel\Sanctum\HasApiTokens;
 use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Login extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasApiTokens;

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
    protected $table="users";
//protected $guard="admin";
    public $timestamps=false;
    protected $fillable=[
            'fname', 'email','passowrd','status',
 'lname',  'address',  'phone', 'rank',
    ];
 /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

 /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
   

    /**
     * The attributes that should be cast.
     *
     * @var array
     */

}
