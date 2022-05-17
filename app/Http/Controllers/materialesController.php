<?php
 
namespace App\Http\Controllers;

use App\Models\materialsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\LogAction;

class materialesController extends Controller
{
    private $idApp = 11;
    private $slug  = 'materiales';

    function index(){
            if (!Auth::User()->canApp($this->idApp)){
                return redirect()->route('errorAccess');
            }

            return view( $this->slug.'.index' , ['modulos'=> materialsModel::orderby('description')->get() , 'permission'=>Auth::User()->permission($this->idApp)]);

    }

    function add(){
       
        if (!Auth::User()->acction($this->idApp,'anew')){
            return response()->json(['html'=> msgController::notPermission()]);
        } 

        return response()->json(['html'=> view($this->slug.'.form' , ['module'=>new materialsModel])->render()]);

    }

    function edit($id){
       
        if (!Auth::User()->acction($this->idApp,'aedit')){
            return response()->json(['html'=> msgController::notPermission()]);
        } 

        return response()->json(['html'=> view($this->slug.'.form' , ['module'=>materialsModel::find($id)])->render()]);

    }

    function delete($id){
        

        if (!Auth::User()->acction($this->idApp,'adelete')){
           return redirect()->route('errorAccess');
        } 

        $modulo =  materialsModel::where('id',$id);
        logAction::log("Elimino el material <b>{$modulo->first()->description}</b>.",'delete');
        $modulo->delete();
        return redirect()->route($this->slug)->with('alert-success','Material eliminado correctamente');

    }

    function save(Request $req){
       
        if (!Auth::User()->acction($this->idApp,'aedit')){
            return redirect()->route('errorAccess');
        } 

       
        $args = [   
                    'code'=>$req->code,
                    'description'=>$req->description,
                    'measure_id'=>$req->measure_id,
                    'value'=>$req->value ,
                    'updated_at'=> Carbon::now()
                ];    
        
        if ($req->password){
            $args['password'] = bcrypt($req->password);
        }   

        if (!$req->id){
            LogAction::log("Agrego el material <b>{$req->description}</b>.",'insert');
            $args['created_at'] = Carbon::now();
            materialsModel::insert($args);
        }else{
            materialsModel::where('id',$req->id)->update($args);
            LogAction::log("Actualizo la información del material <b>{$req->description}</b>.",'update');
        }

        return redirect()->route($this->slug)->with('alert-success','Infomación guardada correctamente');

    }

}
