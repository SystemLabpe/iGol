<?php
/**
 * Created by PhpStorm.
 * User: josue
 * Date: 13/10/2017
 * Time: 5:07 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Schedule extends  Model {

    protected $fillable = [
        'schedule_day','init_hour','price','available'
    ];


    protected $hidden = [

    ];

    public function venue(){
        return $this->belongsTo('App\Venue');
    }


}