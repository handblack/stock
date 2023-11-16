<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VBalanza extends Model
{
    use HasFactory;
    protected $table = 'v_balanza';
    protected $dates = ['fecha_ingreso','fecha_local']   ;
}
