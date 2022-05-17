<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profpermission extends Model
{
    use HasFactory;

    protected $table = "profpermissions";


    static public function getPermiso($profid , $appId , $action){
        return profpermission::where('profid', $profid)->where('modappid',$appId)->where($action,1)->first();
    }

}
