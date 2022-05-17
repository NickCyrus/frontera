<?php

namespace App\Http\Controllers;

use App\Models\jobsModell;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\LogAction;

class personalController extends Controller
{
    //
    private $idApp = 8;
 
        function index(){
                if (!Auth::User()->canApp($this->idApp)){
                    return redirect()->route('errorAccess');
                }

                return view('personal.index' , ['modulos'=> jobsModell::orderby('description')->get() , 'permission'=>Auth::User()->permission($this->idApp)]);

        }

        function add(){
           
            if (!Auth::User()->acction($this->idApp,'anew')){
                return response()->json(['html'=> msgController::notPermission()]);
            } 

            return response()->json(['html'=> view('personal.form' , ['module'=>new jobsModell])->render()]);

        }

        function edit($id){
           
            if (!Auth::User()->acction($this->idApp,'aedit')){
                return response()->json(['html'=> msgController::notPermission()]);
            } 

            return response()->json(['html'=> view('personal.form' , ['module'=>jobsModell::find($id)])->render()]);

        }

        function delete($id){
           
            

            if (!Auth::User()->acction($this->idApp,'adelete')){
               return redirect()->route('errorAccess');
            } 

            $modulo =  jobsModell::where('id',$id);
            logAction::log("Elimino el personal <b>{$modulo->first()->description}</b>.",'delete');
            $modulo->delete();
            return redirect()->route('personal')->with('alert-success','Personal eliminado correctamente');

        }

        function save(Request $req){
           
            if (!Auth::User()->acction($this->idApp,'aedit')){
                return redirect()->route('errorAccess');
            } 

           
            $args = [
                        'code'=>$req->code,
                        'description'=>$req->description,
                        'valuemonth'=>$req->valuemonth,
                        'valueday'=>$req->valueday,
                        'updated_at'=> Carbon::now()
                    ];    
            
                 
            if (!$req->id){
                LogAction::log("Agrego el tipo de personal <b>{$req->description}</b>.",'insert');
                $args['created_at'] = Carbon::now();
                jobsModell::insert($args);
            }else{
                jobsModell::where('id',$req->id)->update($args);
                logAction::log("Actualizo la información del personal <b>{$req->description}</b>.",'update');
            }

            return redirect()->route('personal')->with('alert-success','Infomación guardada correctamente');

        }

}
