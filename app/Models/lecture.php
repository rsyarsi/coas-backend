<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lecture extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = "lectures";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'groupspecialistID',     
        'name',
        'doctotidsimrs',        
        'active' 
    ];
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];
}
