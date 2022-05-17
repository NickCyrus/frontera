<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itemsModel extends Model
{
    use HasFactory;


    protected $table = "items";


    public function getMeasure(){
        return measures::where('id', $this->measure_id)->first()->description;
    }


    public function inContract($idcontrato){
        return contractsItemsModel::where('idcontracts', $idcontrato)->where('iditems',$this->id)->first() ?? false;
    }


}
