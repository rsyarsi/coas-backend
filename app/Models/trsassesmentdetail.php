<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trsassesmentdetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'trsassementID',     
        'assesmentdetailID',
        'assementdescription',        
        'Assementvalue',        
        'assementbobotvalue',        
        'assementscore',             
        'active' 
    ];
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];
}
