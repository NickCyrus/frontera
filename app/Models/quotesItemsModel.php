<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quotesItemsModel extends Model
{
    use HasFactory;


    protected $table = "quotes_items";
    protected $fillable = ['id'];

    static public function getItem($id){
        return itemsModel::where('id', $id ?? $this->item_id)->first();
    }

    public function getItemPrice(){
         //$item = itemsModel::where('id',$this->item_id)->first();
         //return $item->value;
         return $this->item_valor;
    }

    public function getItemName(){
        $item = itemsModel::where('id',$this->item_id)->first();
        return $item->description;
    }

    public function getItEatos(){
        $item = itemsModel::where('id',$this->item_id)->first();
        return $item->aetos;
    }

    public function getMeasure(){
        return itemsModel::where('id',$this->item_id)->first()->getMeasure();
    }

}
