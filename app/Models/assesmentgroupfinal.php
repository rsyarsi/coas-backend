<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assesmentgroupfinal extends Model
{
    use HasFactory;
    protected $table = "assesmentgroupfinals";
    protected $fillable = [
        'id',
        'name',   
        'active'
    ];

    public $incrementing = false;

    protected $casts = [
        'id' => 'string'
    ];
}
