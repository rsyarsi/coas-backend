<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $table = "semesters";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'semestername',
        'semestervalue',
        'active'
    ];
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];
}
