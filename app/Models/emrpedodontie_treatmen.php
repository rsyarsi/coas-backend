<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emrpedodontie_treatmen extends Model
{
    use HasFactory;
    protected $table = "emrpedodontie_treatmens";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'emrid',
        'datetreatment',
        'itemtreatment', 
        'supervisorvalidate',         
        'userentryname', 
        'supervisorname', 

    ];
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];
}
