<?php
/**
 * Created by PhpStorm.
 * User: josue
 * Date: 13/10/2017
 * Time: 7:31 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Role extends Model{

    protected $fillable = [
        'name'
    ];


    protected $hidden = [

    ];


}