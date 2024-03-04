<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assesmentgroup extends Model
{
    use HasFactory;
    protected $table = "assesmentgroups";
    /**
     * The attributes that are mass assignable.s
     *
     * @var array<int, string>
     */

   


    protected $fillable = [
        'specialistID',
        'idassesmentgroupfinal',    
        'isskala',
        'assementgroupname',         
        'type',
        'valuetotal',
        'active' 

    ];
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];
}
