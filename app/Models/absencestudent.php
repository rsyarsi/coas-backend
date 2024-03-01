<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absencestudent extends Model
{
    use HasFactory;
    protected $table = "absencestudents";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'studentid',     
        'time_in',
        'time_out',
        'statusabsensi',   
        'periode',
        'date' 
    ];
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];
}
