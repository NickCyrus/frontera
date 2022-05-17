<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $appId;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    function getAvatar($url = '' ){

            if ($url){
                return $this->avatar;
            }

            if (!$this->avatar){

                  return view('component.avatar',['iniciales'=> substr($this->name,0,2)]) ; 
            }else{
                    return view('component.avatar',['avatar'=>$this->avatar]);
            }
    }

    public function getNameRol(){

         return  profileModel::find($this->profid)->first()->profname;

    }


    public function getLogConection($limit = ''){
        if ($limit){
            return LogLogin::where('userid', $this->id)->orderby('created_at','DESC')->limit($limit)->get();
        }else{
            return LogLogin::where('userid', $this->id)->orderby('created_at','DESC')->get();
        }
    }

    public function getLogAcction($limit = ''){
        if ($limit){
            return LogAction::where('userid', $this->id)->orderby('created_at','DESC')->limit($limit)->get();
        }else{
            return LogAction::where('userid', $this->id)->orderby('created_at','DESC')->get();
        }
    }


    public function getMenuLeft(){
                $modules  = profpermission::where('profid', $this->profid)->select('modappid')->get()->toArray();
               return modulesapp::whereIn('id', $modules)->orderby('orderapp')->get();
    }

    public function canApp($appId){
        return profpermission::where('profid', $this->profid)->where('modappid',$appId)->where('aview',1)->first();       
    }

    public function permission($appId){
        return profpermission::where('profid', $this->profid)->where('modappid',$appId)->first();       
    }

    public function acction($appId , $action){
        return profpermission::where('profid', $this->profid)->where('modappid',$appId)->where($action,1)->first();       
    }


}
