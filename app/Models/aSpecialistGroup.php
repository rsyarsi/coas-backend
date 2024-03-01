<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialistGroup extends Model
{
    use HasFactory;
    protected $table = "SpecialistGroups";
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
