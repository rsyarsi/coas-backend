<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class hospital extends Model
{
    use HasFactory ;
    protected $table = "hospitals";
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
