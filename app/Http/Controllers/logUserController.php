<?php

namespace App\Http\Controllers;

use App\Models\LogAction;
use Illuminate\Http\Request;

class logUserController extends Controller
{
    
        function index(){
                return view('logsusers.index' , ['logs'=>LogAction::orderby('created_at','DESC')->get()] );
        }
 
}
