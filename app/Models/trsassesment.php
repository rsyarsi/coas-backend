<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trsassesment extends Model
{
    use HasFactory;
    protected $fillable = [
        'assesmentdetailID',     
        'studentID',
        'lectureID',        
        'yearID',        
        'semesterID',        
        'transactiondate',        
        'grandotal',        
        'active' 
    ];
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];

}
