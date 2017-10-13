<?php
/**
 * Created by PhpStorm.
 * User: josue
 * Date: 13/10/2017
 * Time: 2:55 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Venue;

class VenueController extends Controller {

    public function index(){
        $venues = Venue::get();
        return $this->createDataResponse($venues);
    }


    public function create(){

    }

    public function store(Request $request){
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'day_price' => 'required',
            'night_price' => 'required',
            'parking' => 'required',
            'play_area' => 'required'
        ];
        $this->validate($request, $rules);

        $venue = new Venue();
        $venue->name = $request->name;
        $venue->address = $request->address;
        $venue->phone = $request->phone;
        $venue->latitude = $request->latitude;
        $venue->longitude = $request->longitude;
        $venue->day_price = $request->day_price;
        $venue->night_price = $request->night_price;
        $venue->parking = $request->parking;
        $venue->play_area = $request->play_area;
        $venue->save();

    }

    public function show($id){

    }


    public function edit($id){

    }


    public function update(Request $request, $id){

    }


    public function destroy($id){
        //
    }

}