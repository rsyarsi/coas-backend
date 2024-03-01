<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;
 
    protected $table = "Lectures";
    /**
     * The attributes that are mass assignable.s
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'groupspecialistID',     
        'name',        
        'nim',
        'doctotidsimrs',        
        'active' 
    ];
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];
}
