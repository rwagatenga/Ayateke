<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersTap extends Model
{
    //
    protected $table = 'pers_taps';

    public function reports() {
    	return $this->hasMany('App\Report');
    }
}
