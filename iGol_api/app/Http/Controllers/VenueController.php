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

    }

    public function show($id){

    }


    public function edit($id){

    }


    public function update(Request $request, $id){

    }


    public function destroy($id){
        
    }

}