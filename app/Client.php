<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = [
       'clientTypeId', 'organisationId', 'villageId', 'lineId', 'code', 'firsname', 'surname', 'idCard', 'phoneNumber1', 'phoneNumber2', 'counterNumber', 'firstConnection', 'comment'
    ];

    protected $table = "clients";

    public function type()
    {
      return $this->belongsTo(ClientType::class, 'clientTypeId', 'id');
    }
}
