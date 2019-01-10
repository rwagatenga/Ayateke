<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlanchUser extends Model
{
    //
    protected $fillable = [
        'blancheId', 'userId',
    ];

    protected $table = "blanche_users";
}
