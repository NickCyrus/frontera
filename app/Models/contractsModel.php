<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class contractsModel extends Model
{
    use HasFactory;

    protected $table = "contracts";


    public function items(){
         return itemsModel::whereIn('id', contractsItemsModel::where('idcontracts', $this->id)->select('iditems')->get()->toArray())->get();
    }

    public function itemsNotInclude($idcontizacion){
        return itemsModel::whereIn('id', 
                                    contractsItemsModel::where('idcontracts', $this->id)
                                    ->whereNotIn('iditems', quotesItemsModel::where('quote_id', $idcontizacion)->select('item_id')->get()->toArray())
                                    ->select('iditems')->get()->toArray()
                                   )->get();
    }
    
    public function cotizaciones(){
        return quotesModel::where('contracts_id', $this->id)->orderby('id','DESC')->get();
    }

    
    public function sumCreados(){
        return quotesModel::where('contracts_id', $this->id)->sum('vr_creada');
    }

    public function sumPendientes(){
        return quotesModel::where('contracts_id', $this->id)->sum('vr_pendiente');
    }

    
    public function sumSuspendido(){
        return quotesModel::where('contracts_id', $this->id)->sum('vr_suspendidos');
    }

    public function sumSinAprobar(){
        return quotesModel::where('contracts_id', $this->id)->sum('vr_aprobar');
    }

    public function sumAprobado(){
        return quotesModel::where('contracts_id', $this->id)->sum('vr_aprobado');
    }
    
}
