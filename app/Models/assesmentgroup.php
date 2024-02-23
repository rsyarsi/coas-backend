<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assesmentgroup extends Model
{
    use HasFactory;
    protected $table = "assesmentgroups";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'specialistID',
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
