<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materialsModel extends Model
{
    use HasFactory;

    protected $table = "materials";


    public function getMeasure(){
        return measures::where('id', $this->measure_id)->first()->description;
    }

}