<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhLogChange extends Model
{
    use HasFactory;
    protected $dates = ['created_at'];
    protected $casts   = [
        'datasource' => 'object',
        'datachange' => 'object',
    ];

    public function vusuario(){
        return $this->hasOne(Usuario::class,'usuario_id','usuario_id');
    }


}
