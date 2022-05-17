<?php

namespace App\Http\Controllers;

use App\Models\LogAction;
use App\Models\LogLogin;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class perfilController extends Controller
{
    

        public function index(){

                return view('profile.user',['user'=> Auth::User()]);

        }


        public function logaccess(){

                $rs = LogLogin::where('userid', Auth::User()->id)->paginate(10);
                return view('profile.logaccess', ['userlog'=> $rs ] );        

        }


        public function changepassword(Request $q){

                if ($q->password){
                          User::find(  Auth::User()->id )->update(['password'=> bcrypt($q->password)]);
                          LogAction::log('Actualizo contraseña del perfil','update');     
                }

                return redirect()->route('profile')->with('alert-success','Contraseña actualizada !!');

        }

}
