<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assesmentdetail extends Model
{
    use HasFactory;
    protected $table = "assesmentdetails";
    /**sssss
     * The attributes that are mass aassignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'assesmentgroupID',     
        'assementdescription',
        'assementbobotvalue',           
        'kodesub',      
        'index_sub', 
        'kode_sub_name',
        'active' 
    ];
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];
}
