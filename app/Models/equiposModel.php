<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equiposModel extends Model
{
    use HasFactory;

    protected $table = "equipments";
    protected $fillable = ['id'];

    public function getMeasure(){
            return measures::where('id', $this->measure_id)->first()->description;
    }

}
