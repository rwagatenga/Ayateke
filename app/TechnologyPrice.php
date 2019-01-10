<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechnologyPrice extends Model
{
    //
    protected $fillable = [
        'technologyId', 'amount','amount','date','Status'
     ];
 
     protected $table = "Technology_Prices";
}
