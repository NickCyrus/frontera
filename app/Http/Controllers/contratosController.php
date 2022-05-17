<?php

namespace App\Http\Controllers;

use App\Mail\CotizacionMail;
use App\Models\contractsItemsModel;
use App\Models\contractsModel;
use App\Models\itemsModel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\LogAction;
use App\Models\LogSendMail;
use App\Models\quotesItemsModel;
use App\Models\quotesModel;
use Illuminate\Support\Facades\Mail;

class contratosController extends Controller
{
    private $idApp = 10;
    private $slug  = 'contratos';

    function index(){
            if (!Auth::User()->canApp($this->idApp)){
                return redirect()->route('errorAccess');
            }

            return view( $this->slug.'.index' , ['modulos'=> contractsModel::orderby('initialdate','DESC')->get() , 'permission'=>Auth::User()->permission($this->idApp)]);

    }

    function add(){

        if (!Auth::User()->acction($this->idApp,'anew')){
            return response()->json(['html'=> msgController::notPermission()]);
        }

        return response()->json(['html'=> view($this->slug.'.form' , ['module'=>new contractsModel])->render()]);

    }

    function edit($id){

        if (!Auth::User()->acction($this->idApp,'aedit')){
            return response()->json(['html'=> msgController::notPermission()]);
        }

        return response()->json(['html'=> view($this->slug.'.form' , ['module'=>contractsModel::find($id)])->render()]);

    }

    function delete($id){


        if (!Auth::User()->acction($this->idApp,'adelete')){
           return redirect()->route('errorAccess');
        }

        $modulo =  contractsModel::where('id',$id);
        logAction::log("Elimino el contrato <b>{$modulo->first()->contractor} - {$modulo->first()->name}</b>.",'delete');
        $modulo->delete();
        return redirect()->route($this->slug)->with('alert-success','Contrato eliminado correctamente');

    }


    function delete_item($idcontrato , $iditem){


        if (!Auth::User()->acction($this->idApp,'adelete')){
           return redirect()->route('errorAccess');
        }

        $modulo     =  contractsItemsModel::where('idcontracts', $idcontrato)->where('iditems',$iditem);
        // logAction::log("Elimino el contrato <b>{$modulo->first()->contractor} - {$modulo->first()->name}</b>.",'delete');
        $modulo->delete();
        return redirect()->route($this->slug.'.items',['id'=>$idcontrato])->with('alert-success','Item eliminado correctamente');

    }




    function save(Request $req){

        if (!Auth::User()->acction($this->idApp,'aedit')){
            return redirect()->route('errorAccess');
        }


        $args = [
                    'initialdate'=>$req->initialdate,
                    'contractor'=>$req->contractor,
                    'name'=>$req->name,
                    'number'=>$req->number,
                    'price'=>$req->price ,
                    'term'=>$req->term ,
                    'updated_at'=> Carbon::now()
                ];


        if (!$req->id){
            LogAction::log("Agrego el contrato <b>{$req->contractor} - {$req->name}</b>.",'insert');
            $args['created_at'] = Carbon::now();
            contractsModel::insert($args);
        }else{
            contractsModel::where('id',$req->id)->update($args);
            LogAction::log("Actualizo la información del contrato <b>{$req->contractor} - {$req->name}</b>.",'update');
        }

        return redirect()->route($this->slug)->with('alert-success','Infomación guardada correctamente');

    }


    public function items($id){

        if (!Auth::User()->acction($this->idApp,'aedit')){
            return redirect()->route('errorAccess');
        }

        return view('contratos.items',['contrato'=>contractsModel::where('id',$id)->first() , 'permission'=>Auth::User()->permission($this->idApp) ]);

    }





    public function add_item($id){
        return view('contratos.items_add',['contrato'=>contractsModel::where('id',$id)->first() ,
                                           'items'=>itemsModel::all(),

                                           'permission'=>Auth::User()->permission($this->idApp) ]);
    }


    public function ajax(Request $r , $opc){

            switch($opc){
                case 'addItemContrato':
                    if ($r->add == 'true'){
                        contractsItemsModel::insert(['idcontracts'=>$r->idcontrato , 'iditems'=>$r->iditem]);
                    }else{
                        contractsItemsModel::where('idcontracts', $r->idcontrato)->where('iditems',$r->iditem)->delete();
                    }
                break;
            }


    }

    public function cotizaciones($id){

        if (!Auth::User()->acction($this->idApp,'aedit')){
            return redirect()->route('errorAccess');
        }

        return view('contratos.cotizaciones',['contrato'=>contractsModel::where('id',$id)->first() , 'permission'=>Auth::User()->permission($this->idApp) ]);

    }

    public function add_cotizacion($idcontrato){

        if (!Auth::User()->acction($this->idApp,'anew')){
            return response()->json(['html'=> msgController::notPermission()]);
        }


        return response()->json(['html'=> view($this->slug.'.cotizacionform' ,
                                                ['module'=>new quotesModel,
                                                 'contrato'=> contractsModel::where('id',$idcontrato)->first()])->render()]);

    }

    public function edit_cotizacion($idcontrato , $item){

        if (!Auth::User()->acction($this->idApp,'aedit')){
            return response()->json(['html'=> msgController::notPermission()]);
        }

        return response()->json(['html'=> view($this->slug.'.cotizacionform' ,
                                                ['module'=>quotesModel::find($item),
                                                 'all'=>true,
                                                 'contrato'=> contractsModel::where('id',$idcontrato)->first()])->render()]);

    }

    public function save_cotizaciones(Request $r , $contracts_id){

            $args = [
                        'contracts_id'=>$contracts_id,
                        'description'=>$r->description,
                        'lider_fec'=>$r->lider_fec,

                    ];


            if (!$r->id){
                LogAction::log("Agrego la cotización <b>{$r->description} - {$r->lider_fec}</b>.",'insert');
                $args['created_at'] = Carbon::now();
                $args['state']      =  1;

                quotesModel::insert($args);
            }else{

                $cotizacion =  quotesModel::where('id',$r->id);

                if ($r->state){
                    $args['cc_solutec'] = $r->cc_solutec;
                    $args['n_pr']       = $r->n_pr;
                    $args['n_pedido']   = $r->n_pedido;
                    $args['state']      = $r->state;
                    $args['updated_at'] = Carbon::now();
                }
                
                $cotizacion->update($args);

                quotesModel::updateSum($r->id);        

                LogAction::log("Actualizo la cotización <b>{$r->description} - {$r->lider_fec}</b>.",'update');
            }

            return redirect()->route($this->slug.'.cotizaciones',['id'=>$contracts_id])->with('alert-success','Infomación guardada correctamente');

    }


    public function delete_cotizacion($idcontrato , $item){
          quotesModel::where('contracts_id', $idcontrato)->where('id',$item)->delete();

          return $this->cotizaciones($idcontrato);
    }


    public function items_cotizacion($idcontrato, $idcontiza){

        if (!Auth::User()->acction($this->idApp,'aedit')){
            return redirect()->route('errorAccess');
        }

        return view('contratos.cotizacionesitems',[
                                                    'contrato'=>contractsModel::where('id',$idcontrato)->first() ,
                                                    'items_cotizacion'=>quotesItemsModel::where('contracts_id',$idcontrato)->where('quote_id',$idcontiza)->get(),
                                                    'cotizacionid'=>$idcontiza ,
                                                    'cotizacion'=>quotesModel::where('id',$idcontiza)->first(),
                                                    'permission'=>Auth::User()->permission($this->idApp)
                                                  ]);
    }


    function item_cotizacion($idcontrato, $idcontiza , $iditem){



        if (!Auth::User()->acction($this->idApp,'anew') && !Auth::User()->acction($this->idApp,'aedit') ){
            return redirect()->route('errorAccess');
        }


        return response()->json(['html'=> view('contratos.cotizacionitemform', [
                                                      'contrato'=>contractsModel::where('id',$idcontrato)->first(),
                                                      'cotizacion'=>quotesModel::where('id',$idcontiza)->first(),
                                                      'item'=>itemsModel::where('id',$iditem)->first()
                                                    ])->render()]);

    }


    function itemsave_cotizacion(Request $r , $idcontrato, $idcontiza , $iditem){

            $args = [
                        'contracts_id'=>$idcontrato,
                        'quote_id'=>$idcontiza,
                        'item_id'=>$iditem,
                        'item_valor'=> itemsModel::find($iditem)->value,
                        'item_quantity'=>$r->item_quantity
                    ];

            quotesItemsModel::insert($args);
            
            quotesModel::updateSum($idcontiza);
            
            return redirect()->route('contratos.cotizaciones.items',['id'=>$idcontrato , 'item'=>$idcontiza]);

    }

    function itemdelete_cotizacion($idcontrato, $idcontiza , $iditem){

        quotesItemsModel::where('contracts_id',$idcontrato)
                           ->where('quote_id',$idcontiza)
                           ->where('id',$iditem)
                           ->delete();

        quotesModel::updateSum($idcontiza);

        return $this->items_cotizacion($idcontrato, $idcontiza );
    }


    public function showpdf($id){

        return response()->json(['html'=>view('contratos.cotizaciones.showpdf',['cotizacionid'=>$id])->render()]);

    }

    public function sendmail_cotizacion(Request $r, $item){

        $to = explode(',',$r->to);    
        
        $cotizacion = quotesModel::where('id',$item)->first();

        $pdf = app('dompdf.wrapper');
  
        $pdf->setPaper('letter', 'landscape')->loadView('pdf.cotpresentada', ['cotizacion'=>$cotizacion]);
        $name = public_path()."/pdf/Presupuesto N° {$cotizacion->id}.pdf";
        $pdf->save($name);
 
        if (Mail::to($to)->send( new CotizacionMail($cotizacion , $r , $name ) )){
                unlink($name);
                // Guardamos el registro del envio
                $args= [
                        'userId'=>Auth::User()->id,
                        'subjet'=>$r->subject ?? 'Sin asunto',
                        'sendTo'=>$r->to ?? 'Error de almacenamiento',
                        'adjunto'=>null,
                        'sendBody'=>$r->msg,
                        'created_at'=>Carbon::now(),
                        'updated_at'=>Carbon::now()
                ];

                LogSendMail::insert($args);

                if ($cotizacion->state == 1){
                    quotesModel::where('id',$item)->update(['state'=>2]);
                    quotesModel::updateSum($item);
                }

                return redirect()->route('contratos.cotizaciones',['id'=>$cotizacion->contracts_id])->with('alert-success','Presupuesto enviado correctamente.');
        }else{
                return redirect()->route('contratos.cotizaciones',['id'=>$cotizacion->contracts_id])->with('alert-error','Error duránte el envío.');
        }

        

    }

}
