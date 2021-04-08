<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'bds_user';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_role',
        'password',
        'email',
        'fullname',
        'birth_date',
        'gender',
        'address',
        'cmnd',
        'phone',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

}
