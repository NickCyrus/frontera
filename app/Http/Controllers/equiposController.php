<?php

namespace App\Http\Controllers;

use App\Models\equiposModel;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\LogAction;

class equiposController extends Controller
{
    private $idApp = 9;
    private $slug  = 'equipos';

    function index(){
            if (!Auth::User()->canApp($this->idApp)){
                return redirect()->route('errorAccess');
            }

            return view( $this->slug.'.index' , ['modulos'=> equiposModel::orderby('description')->paginate(10) , 'permission'=>Auth::User()->permission($this->idApp)]);

    }

    function add(){
       
        if (!Auth::User()->acction($this->idApp,'anew')){
            return response()->json(['html'=> msgController::notPermission()]);
        } 

        return response()->json(['html'=> view($this->slug.'.form' , ['module'=>new equiposModel])->render()]);

    }

    function edit($id){
       
        if (!Auth::User()->acction($this->idApp,'aedit')){
            return response()->json(['html'=> msgController::notPermission()]);
        } 

        return response()->json(['html'=> view($this->slug.'.form' , ['module'=>equiposModel::find($id)])->render()]);

    }

    function delete($id){
        

        if (!Auth::User()->acction($this->idApp,'adelete')){
           return redirect()->route('errorAccess');
        } 

        $modulo =  equiposModel::where('id',$id);
        logAction::log("Elimino el equipo <b>{$modulo->first()->description}</b>.",'delete');
        $modulo->delete();
        return redirect()->route($this->slug)->with('alert-success','Equipo eliminado correctamente');

    }

    function save(Request $req){
       
        if (!Auth::User()->acction($this->idApp,'aedit')){
            return redirect()->route('errorAccess');
        } 

       
        $args = [
                    'description'=>$req->description,
                    'measure_id'=>$req->measure_id,
                    'valuemonth'=>$req->valuemonth,
                    'valueday'=>$req->valueday,
                    'valuehours'=>$req->valuehours,
                    'updated_at'=> Carbon::now()
                ];    
        
        if ($req->password){
            $args['password'] = bcrypt($req->password);
        }   

        if (!$req->id){
            LogAction::log("Agrego el equipo <b>{$req->description}</b>.",'insert');
            equiposModel::insert($args);
        }else{
            equiposModel::where('id',$req->id)->update($args);
            LogAction::log("Actualizo la información del equipo <b>{$req->description}</b>.",'update');
        }

        return redirect()->route($this->slug)->with('alert-success','Infomación guardada correctamente');

    }

}
