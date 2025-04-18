<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QCategory extends Model
{
    /** @use HasFactory<\Database\Factories\QCategoryFactory> */
    use HasFactory;

    protected $guarded = [];

    public  function qrcodes(){
        return $this->hasMany(Qrcode::class);
    }


    
}
