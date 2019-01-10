<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
class report extends Model
{
    //
    protected $fillable = [
       'cId', 'index','m3','amount','paid','userId'
    ];

    protected $table = "reports";
=======
class Report extends Model
{
    //
    protected $table = 'reports';

    public function perstaps() {
    	return $this->belongTo('App\PersTap', 'water_meter');
    }
>>>>>>> aa659fe1537f4faa13cb03b5d947c812ed3c169e
}
