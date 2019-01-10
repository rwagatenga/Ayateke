<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientType extends Model
{
    //
    protected $fillable = [
       'name',
    ];

    protected $table = "client_types";

    public function clients()
    {
      return $this->belongsTo(Client::class, 'clientTypeId', 'id');
    }
}
