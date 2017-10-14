<?php
/**
 * Created by PhpStorm.
 * User: josue
 * Date: 13/10/2017
 * Time: 7:26 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class ScheduleAvailability extends Model{

    protected $fillable = [
        'field_date','schedule_availability_status','price'
    ];


    protected $hidden = [

    ];

    public function schedule(){
        return $this->belongsTo('App\Schedule');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }



}