<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emrperiodontie_soap extends Model
{
    use HasFactory; 
    protected $table = "emrperiodontie_soaps";
    protected $fillable = [
        'id',
        'datesoap',
        'terapi_s',
        'terapi_o', 
        'terapi_a',         
        'terapi_p', 
        'user_entry',
        'user_entry_name', 
        'user_verify',         
        'user_verify_name',          
        'date_verify',          
        'idemr',   
        'active'
    ];

    public $incrementing = false;

    protected $casts = [
        'id' => 'string'
    ];
 
}
