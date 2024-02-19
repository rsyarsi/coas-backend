<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patient extends Model
{
    use HasFactory;
    protected $table = "patients";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 
        'noepisode',
        'noregistrasi',        
        'nomr',
        'patientname',        
        'namajaminan',
        'noantrianall',
        'gander',
        'date_of_birth',
        'address',
        'idunit',
        'visit_date',        
        'namaunit',
        'iddokter',
        'namadokter',
        'patienttype',
        'statusid', 


    ];
  
}
