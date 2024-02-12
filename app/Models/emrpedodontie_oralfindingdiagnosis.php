<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emrpedodontie_oralfindingdiagnosis extends Model
{
    use HasFactory;
    protected $table = "emrpedodontie_oralfindingdiagnosis";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "emrid",
        "oralfinding",
        "diagnosis",
        "treatmentplan"

    ];
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];
}
