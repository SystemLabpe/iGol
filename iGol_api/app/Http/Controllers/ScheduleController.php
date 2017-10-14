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
        $schedules = Schedule::where('schedule_day','=',date('N', strtotime($date)))
            ->where('venue_id','=',$venueId)
            ->get();
        if(count($schedules)>0){
            return $this->createDataResponse($schedules);
        }
        return $this->createErrorResponse('No results', config('customErrors.NO_LIST_RESULTS'));
    }

}