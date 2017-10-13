<?php
/**
 * Created by PhpStorm.
 * User: josue
 * Date: 13/10/2017
 * Time: 2:39 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Venue extends Model {

    protected $fillable = [
        'name','address','phone','latitude','longitude','day_price','night_price','img','parking','play_area'
    ];


    protected $hidden = [

    ];

    public function schedules(){
        return $this->hasMany('App\Schedule');
    }



}