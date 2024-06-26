<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emrpedodontie_behaviorrating extends Model
{
    use HasFactory;
    protected $table = "emrpedodontie_behaviorratings";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'emrid',
        'frankscale',
        'beforetreatment', 
        'duringtreatment', 
    ];
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];
}