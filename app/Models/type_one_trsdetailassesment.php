<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_one_trsdetailassesment extends Model
{
    use HasFactory;
    protected $table = "type_one_trsdetailassesments";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

   
    protected $fillable = [
        'trsassesmentid',     
        'assesmentdetailid',
        'assesmentdescription',        
        'transactiondate',
        'assesmentskala', 
        'assesmentbobotvalue', 
        'assementscore', 
        'active' 
    ];
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];
}
