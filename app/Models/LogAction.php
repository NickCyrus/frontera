<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
 

class LogAction extends Model
{
    use HasFactory;

    protected $table = "log_actions";


    function user(){
        return User::where('id', $this->userid)->select('name')->first()->name;
    }

    static public function log($comment , $action , $fbefore = '' , $fafter=''){

        LogAction::insert(['userid'=>Auth::User()->id,
                           'comment'=>$comment,
                           'ipaccess'=> Request()->ip(),
                           'action'=>$action,
                           'fbefore'=>$fbefore,
                           'fafter'=>$fafter,
                           'created_at'=>Carbon::now(),
                           ]);

    }


}
