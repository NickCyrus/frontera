<?php

namespace App\Http\Controllers;

use App\Models\LogAction;
use App\Models\modulesapp;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class modulesController extends Controller
{

        private $idApp = 1;

        function __construct()
        {
           
                
        }

        function index(){
                if (!Auth::User()->canApp($this->idApp)){
                    return redirect()->route('errorAccess');
                }

                return view('modules.index' , ['modulos'=> modulesapp::orderby('orderapp')->get() , 'permission'=>Auth::User()->permission($this->idApp)]);

        }

        function add(){
           
            if (!Auth::User()->acction($this->idApp,'anew')){
                return response()->json(['html'=> msgController::notPermission()]);
            } 

            return response()->json(['html'=> view('modules.form' , ['module'=>new modulesapp])->render()]);

        }

        function edit($id){
           
            if (!Auth::User()->acction($this->idApp,'aedit')){
                return response()->json(['html'=> msgController::notPermission()]);
            } 

            return response()->json(['html'=> view('modules.form' , ['module'=>modulesapp::find($id)])->render()]);

        }

        function delete($id){
           
            

            if (!Auth::User()->acction($this->idApp,'adelete')){
               return redirect()->route('errorAccess');
            } 

            $modulo =  modulesapp::where('id',$id);
            logAction::log("Elimino el módulo <b>{$modulo->first()->nameapp}</b>.",'delete');
            $modulo->delete();
            return redirect()->route('modules')->with('alert-success','Módulo eliminado correctamente');

        }

        function save(Request $req){
           
            if (!Auth::User()->acction($this->idApp,'aedit')){
                return redirect()->route('errorAccess');
            } 

           
            $args = [
                        'nameapp'=>$req->nameapp,
                        'iconapp'=>$req->iconapp,
                        'urlapp'=>$req->urlapp,
                        'orderapp'=>$req->orderapp
                    ];    
            
            if (!$req->id){
                LogAction::log("Agrego el módulos <b>{$req->nameapp}</b>.",'insert');
                $args['created_at'] = Carbon::now();
                modulesapp::insert($args);
            }else{
                modulesapp::where('id',$req->id)->update($args);
                logAction::log("Actualizo el módulos <b>{$req->nameapp}</b>.",'update');
            }

            return redirect()->route('modules')->with('alert-success','Infomación guardada correctamente');

        }



}
