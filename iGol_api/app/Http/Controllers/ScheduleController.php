<?php
/**
 * Created by PhpStorm.
 * User: josue
 * Date: 13/10/2017
 * Time: 6:56 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Schedule;
use App\ScheduleAvailability;

use Log;

class ScheduleController extends Controller{

    public function index(){

    }


    public function create(){

    }

    public function store(Request $request){

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

    public function getByVenueAndDate($venueId,$date){
        //Todo add venue constraint

        $scheduleAvailabilities = ScheduleAvailability::where('field_date',$date)->get();

        $schedules_ids = [];
        foreach($scheduleAvailabilities as $scheduleAvailability){
            array_push($schedules_ids,$scheduleAvailability->schedule_id);
        }

        $schedules = Schedule::where('schedule_day','=',date('N', strtotime($date)))
            ->where('venue_id','=',$venueId)
            ->whereNotIn('id',$schedules_ids)
            ->get();

        if(count($schedules)>0){
            return $this->createDataResponse($schedules);
        }
        return $this->createErrorResponse('No results', config('customErrors.NO_LIST_RESULTS'));
    }

}