<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modulesapp extends Model
{
    use HasFactory;

    protected $table = "modulesapps";
    protected $fillable = ['id'];

}
