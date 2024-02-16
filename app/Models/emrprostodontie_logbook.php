<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emrprostodontie_logbook extends Model
{
    use HasFactory;
    protected $fillable = [
            'id',
            'emrid',
            'dateentri',
            'work',
            'usernameentry',
            'usernameentryname',            
            'lectureid',
            'lecturename', 
            'dateverifylecture'      
    ];
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];
}
