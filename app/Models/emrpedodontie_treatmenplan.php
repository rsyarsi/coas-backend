<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emrpedodontie_treatmenplan extends Model
{
    use HasFactory;
    protected $table = "emrpedodontie_treatmenplans";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'emrid',
        'oralfinding',
        'diagnosis', 
        'treatmentplanning', 
    ];
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];
}
