<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\LogAction;

class usuariosController extends Controller
{
    private $idApp = 3;
    private $slug  = 'usuarios';

    function index(){
            if (!Auth::User()->canApp($this->idApp)){
                return redirect()->route('errorAccess');
            }

            return view( $this->slug.'.index' , ['modulos'=> User::orderby('name')->paginate(10) , 'permission'=>Auth::User()->permission($this->idApp)]);

    }

    function add(){
       
        if (!Auth::User()->acction($this->idApp,'anew')){
            return response()->json(['html'=> msgController::notPermission()]);
        } 

        return response()->json(['html'=> view($this->slug.'.form' , ['module'=>new User])->render()]);

    }

    function edit($id){
       
        if (!Auth::User()->acction($this->idApp,'aedit')){
            return response()->json(['html'=> msgController::notPermission()]);
        } 

        return response()->json(['html'=> view($this->slug.'.form' , ['module'=>User::find($id)])->render()]);

    }

    function delete($id){
       
        

        if (!Auth::User()->acction($this->idApp,'adelete')){
           return redirect()->route('errorAccess');
        } 

        $modulo =  User::where('id',$id);
        logAction::log("Elimino el usuario <b>$modulo->first()->anme} - {$modulo->first()->email}</b>.",'delete');
        $modulo->delete();
        return redirect()->route($this->slug)->with('alert-success','Usuario eliminado correctamente');

    }

    function save(Request $req){
       
        if (!Auth::User()->acction($this->idApp,'aedit')){
            return redirect()->route('errorAccess');
        } 

       
        $args = [
                    'name'=>$req->name,
                    'email'=>$req->email,
                    'profid'=>$req->profid,
                    'updated_at'=> Carbon::now()
                ];    
        
        if ($req->password){
            $args['password'] = bcrypt($req->password);
        }   

        if (!$req->id){
            LogAction::log("Agrego el usuario <b>{$req->name}</b>.",'insert');
            $args['created_at'] = Carbon::now();
            User::insert($args);
        }else{
            User::where('id',$req->id)->update($args);
            logAction::log("Actualizo la información del usuario <b>{$req->name}</b>.",'update');
        }

        return redirect()->route($this->slug)->with('alert-success','Infomación guardada correctamente');

    }

}
