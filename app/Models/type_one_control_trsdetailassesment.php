<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_one_control_trsdetailassesment extends Model
{
    use HasFactory;
    protected $table = "type_one_control_trsdetailassesments";
    protected $fillable = [
        'trsassesmentid',     
        'assesmentdetailid',
        'assesmentdescription',        
        'transactiondate',
        'controlaction', 
        'assementvalue',  
        'kodesub',
        'active' 
    ];
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];
}
