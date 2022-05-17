<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class msgController extends Controller
{
    //

        static public function notPermission(){
            return 'No tiene permisos para esta acción.';
        }
     
}
