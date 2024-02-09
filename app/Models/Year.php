<?php

namespace App\Models;
 
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Year extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "years";
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
