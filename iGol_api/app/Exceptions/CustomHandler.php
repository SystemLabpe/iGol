<?php
/**
 * Created by PhpStorm.
 * User: josue
 * Date: 13/10/2017
 * Time: 1:08 PM
 */

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;

class CustomHandler extends Handler {

    public function render($request, Exception $e) {
        if ($e instanceof ValidationException) {
            return response()->json($e->getResponse()->original, 400);
        }else {
            return response()->json(['message' => "Internal Error",'code' => 500], 500);
        }
    }

}