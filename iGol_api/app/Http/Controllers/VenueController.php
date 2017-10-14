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
use App\Schedule;

use Log;

class VenueController extends Controller {

    public function index(){
        $venues = Venue::get();
        if(count($venues)>0){
            return $this->createDataResponse($venues);
        }
        return $this->createErrorResponse('No results', config('customErrors.NO_LIST_RESULTS'));
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

        $schedules = [];
        for( $i= 1 ; $i <= 7 ; $i++ ){
            for( $j= 1 ; $j <= 24 ; $j++ ){
                $schedule = new Schedule();
                $schedule->schedule_day = $i;
                $schedule->init_hour = $j.':00:00';
                if($j>=9 && $j<18){
                    $schedule->price =  $venue->day_price;
                }else{
                    $schedule->price =  $venue->night_price;
                }
                $schedule->venue_id = $venue->id;
//                $schedule->save();
                array_push($schedules,$schedule);
            }
        }
        $venue->schedules()->savemany($schedules);
        return $this->createSuccessResponse();
    }

    public function show($id){
        $venue = Venue::with('schedules')->find($id);
        if($venue){
            return $this->createDataResponse($venue);
        }
        return $this->createErrorResponse('No Venue', config('customErrors.ENTITY_NOT_FOUND'));
    }


    public function edit($id){

    }


    public function update(Request $request, $id){
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'day_price' => 'required',
            'night_price' => 'required',
            'parking' => 'required',
            'play_area' => 'required',
            'schedules' => 'required'
        ];
        $this->validate($request, $rules);

        $venue = Venue::find($id);
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


        $schedules = $request->schedules;
        foreach($schedules as $schedule){
            $schedule = (object)$schedule;
            $updateSchedule = Schedule::find($schedule->id);
            //TODO add another fields
            if($updateSchedule->available != $schedule->available){
                $updateSchedule->available = $schedule->available;
                $updateSchedule->save();
            }

        }

        return $this->createSuccessResponse();

    }


    public function destroy($id){
        //
    }

}