<?php

namespace App\Http\Controllers;

use App\Models\LogAction;
use App\Models\modulesapp;
use App\Models\profileModel;
use App\Models\profpermission;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class perfilesController extends Controller
{

        private $idApp = 2;
         
        function __construct()
        {
           
                
        }

        function index(){
                if (!Auth::User()->canApp($this->idApp)){
                    return redirect()->route('errorAccess');
                }

                return view('perfiles.index' , ['modulos'=> profileModel::orderby('profname')->get() , 'permission'=>Auth::User()->permission($this->idApp)]);

        }

        function add(){
           
            if (!Auth::User()->acction($this->idApp,'anew')){
                return response()->json(['html'=> msgController::notPermission()]);
            } 

            return response()->json(['html'=> view('perfiles.form' , ['module'=>new profileModel])->render()]);

        }

        function edit($id){
           
            if (!Auth::User()->acction($this->idApp,'aedit')){
                return response()->json(['html'=> msgController::notPermission()]);
            } 

            return response()->json(['html'=> view('perfiles.form' , ['module'=>profileModel::find($id)])->render()]);

        }

        function delete($id){
            
            if (!Auth::User()->acction($this->idApp,'adelete')){
               return redirect()->route('errorAccess');
            } 

            $profile = profileModel::where('id',$id);

            logAction::log("Elimino el perfil <b>{$profile->first()->profname}</b>.",'delete');
            $profile->delete();
            profpermission::where('profid',$id)->delete();
            
            
            return redirect()->route('perfiles')->with('alert-success','Perfil eliminado correctamente');

        }

        function save(Request $req){
             

            if (!Auth::User()->acction($this->idApp,'aedit')){
                return redirect()->route('errorAccess');
            } 

            
            $args = [ 'profname'=>$req->profname ];    
            
            if (!$req->id){
                $args['created_at'] = Carbon::now();
                $id = profileModel::insertGetId($args);
                logAction::log("Creo el perfil <b>{$req->profname}</b>.",'insert');
            }else{
                profileModel::where('id',$req->id)->update($args);
                LogAction::log("Actualizo el perfil <b>{$req->profname}</b>.",'update');
                $id = $req->id; 
            }

            profpermission::where('profid',$id)->delete();
           
            foreach($req->module as $key=>$value){
                profpermission::insert(['profid'=>$id , 
                                        'modappid'=>$key , 
                                        'aview'=>$value['aview'] ?? null, 
                                        'anew'=>$value['anew'] ?? null, 
                                        'aedit'=>$value['aedit'] ?? null , 
                                        'adelete'=>$value['adelete'] ?? null ]);
            }    
 
            return redirect()->route('perfiles')->with('alert-success','Infomación guardada correctamente');

        }



}
