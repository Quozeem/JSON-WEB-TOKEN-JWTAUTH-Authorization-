<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;

class SecondToken extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasApiTokens;

    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
 public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    protected $guard = 'second';
   
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
   public $table="users";
  
    protected $fillable = [
       
        'email',
        'password',
    ];

}
