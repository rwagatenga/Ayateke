<?php

namespace App;

<<<<<<< HEAD
=======
use Laravel\Passport\HasApiTokens;
>>>>>>> aa659fe1537f4faa13cb03b5d947c812ed3c169e
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
<<<<<<< HEAD
    use Notifiable;
=======
    use HasApiTokens, Notifiable;
>>>>>>> aa659fe1537f4faa13cb03b5d947c812ed3c169e

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'name', 'email', 'password', 'roleId'
=======
        'name', 'email', 'password', 'api_token'
>>>>>>> aa659fe1537f4faa13cb03b5d947c812ed3c169e
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
<<<<<<< HEAD
        'password', 'remember_token',
    ];

    protected $table = "users";
=======
        'password', 'remember_token', 'api_token'
    ];
>>>>>>> aa659fe1537f4faa13cb03b5d947c812ed3c169e
}
