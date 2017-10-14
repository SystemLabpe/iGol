<?php
/**
 * Created by PhpStorm.
 * User: josue
 * Date: 13/10/2017
 * Time: 7:34 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ScheduleAvailability;
use App\Schedule;
use App\User;

use Log;

class ScheduleAvailabilityController extends Controller {

    public function index(){

    }


    public function create(){

    }

    public function store(Request $request){
        $rules = [
            'field_date' => 'required',
            'schedule_id' => 'required',
            'user_id' => 'required',
        ];
        $this->validate($request, $rules);

        //TODO validate schedule and user
        $schedule = Schedule::find($request->schedule_id);
        $user = User::find($request->user_id);

        $scheduleAvailability = new ScheduleAvailability();
        $scheduleAvailability->field_date = $request->field_date;
        $scheduleAvailability->price = $schedule->price;
        $scheduleAvailability->schedule_id = $schedule->id;
        $scheduleAvailability->user_id = $user->id;
        $scheduleAvailability->save();
        return $this->createSuccessResponse();
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