<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class specialistgroup extends Model
{
    use HasFactory;
    protected $table = "specialistgroups";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name' 
    ];
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];
}
