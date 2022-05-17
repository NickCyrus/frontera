<?php
 
namespace App\Http\Controllers;

use App\Models\itemsModel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\LogAction;

class itemsController extends Controller
{
    private $idApp = 12;
    private $slug  = 'items';

    function index(){
            if (!Auth::User()->canApp($this->idApp)){
                return redirect()->route('errorAccess');
            }

            return view( $this->slug.'.index' , ['modulos'=> itemsModel::orderby('description')->get() , 'permission'=>Auth::User()->permission($this->idApp)]);

    }

    function add(){
       
        if (!Auth::User()->acction($this->idApp,'anew')){
            return response()->json(['html'=> msgController::notPermission()]);
        } 

        return response()->json(['html'=> view($this->slug.'.form' , ['module'=>new itemsModel])->render()]);

    }

    function edit($id){
       
        if (!Auth::User()->acction($this->idApp,'aedit')){
            return response()->json(['html'=> msgController::notPermission()]);
        } 

        return response()->json(['html'=> view($this->slug.'.form' , ['module'=>itemsModel::find($id)])->render()]);

    }

    function delete($id){
        

        if (!Auth::User()->acction($this->idApp,'adelete')){
           return redirect()->route('errorAccess');
        } 

        $modulo =  itemsModel::where('id',$id);
        logAction::log("Elimino el item <b>{$modulo->first()->description}</b>.",'delete');
        $modulo->delete();
        return redirect()->route($this->slug)->with('alert-success','Material eliminado correctamente');

    }

    function save(Request $req){
       
        if (!Auth::User()->acction($this->idApp,'aedit')){
            return redirect()->route('errorAccess');
        } 

       
        $args = [   
                    'code'=>$req->code,
                    'aetos'=>$req->aetos,
                    'description'=>$req->description,
                    'measure_id'=>$req->measure_id,
                    'value'=>$req->value ,
                    'updated_at'=> Carbon::now()
                ];    
        
        if ($req->password){
            $args['password'] = bcrypt($req->password);
        }   

        if (!$req->id){
            LogAction::log("Agrego el item <b>{$req->description}</b>.",'insert');
            $args['created_at'] = Carbon::now();
            itemsModel::insert($args);
        }else{
            itemsModel::where('id',$req->id)->update($args);
            LogAction::log("Actualizo la información del item <b>{$req->description}</b>.",'update');
        }

        return redirect()->route($this->slug)->with('alert-success','Infomación guardada correctamente');

    }

}
