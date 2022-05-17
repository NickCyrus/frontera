<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class quotesModel extends Model
{
    use HasFactory;

    protected $table = "quotes";
    protected $fillable = ['id'];


    public function getState(){
        $state = quotesStateModel::where('id',$this->state)->first();
        return ($state) ? "<button class='btn btn-xs btn-{$state->color}'>{$state->name}</button>" : '';
    }
 
    static public function getItems($id){
          // dd(quotesItemsModel::where('quote_id',$this->id)->get());
          return quotesItemsModel::where('quote_id',$id)->get();
    }

    static public function sum_Total($id=''){

        $sql =  "SELECT SUM(items.value * quotes_items.item_quantity) as valorTot FROM quotes_items , items
                 WHERE items.id = quotes_items.item_id AND quotes_items.quote_id =". $id ?? $this->id;

        // Se modifica para que tome el valor siempre del cambio calculado
        $sql =  "SELECT SUM(quotes_items.item_valor * quotes_items.item_quantity) as valorTot FROM quotes_items  
                 WHERE  quotes_items.quote_id =". $id ?? $this->id;
 
        $rs =  DB::select($sql);
        return $rs[0]->valorTot;

    }

    static public function updateSum($id){

            $contrato = quotesModel::where('id',$id);
            $total    = quotesModel::sum_Total($id);
            
            $contrato->update(['vr_creada'=>$total]);

            // Entregada P. Aprobación
            if ($contrato->first()->state != 1){
                $contrato->update(['vr_pendiente'=>$total]);  
            }

            if ($contrato->first()->state != 1){
                $contrato->update(['vr_pendiente'=>$total]);  
            }

            // aprobado
            if ($contrato->first()->state == 3){
                $contrato->update(['vr_aprobado'=>$total, 'vr_suspendidos'=>NULL , 'vr_aprobar'=>NULL ]);  
            }
            
            // Suspendido
            if ($contrato->first()->state == 4){
                $contrato->update(['vr_aprobado'=>null, 'vr_suspendidos'=>$total , 'vr_aprobar'=>NULL ]);  
            }

            // NO aprobado
            if ($contrato->first()->state == 5){
                $contrato->update(['vr_aprobado'=>null, 'vr_suspendidos'=>null , 'vr_aprobar'=>$total ]);  
            }


            // Siempre se debe sumar a creada SIEMPRE



    }




}
