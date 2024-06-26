<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trsassesment extends Model
{
    use HasFactory;
    protected $table = "trsassesments";
    protected $fillable = [
        'assesmentgroupid',     
        'studentid',
        'lectureid',        
        'yearid',        
        'semesterid',        
        'transactiondate',        
        'grandotal',        
        'totalbobot',        
        'active'  ,
        'lock'  ,
        'usernamelock'  ,
        'datelock'  ,
    ];
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];

}
