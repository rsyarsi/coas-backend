<?php

namespace App\Repositories\Interfaces;

interface EmrPeriodontieRepositoryInterface
{
    public function createwaktuperawatan($data, $uuid);
    // public function createbehaviorrating($data);
    public function findwaktuperawatan($data);    
    public function viewemrbyRegOperator($data);     
    
    public function updatewaktuperawatan($data);

    public function foto_klinis_oklusi_arah_kiri($data,$upload);   
    public function foto_klinis_oklusi_arah_kanan($data,$upload);   
    public function foto_klinis_oklusi_arah_anterior($data,$upload);   
    public function foto_klinis_oklusal_rahang_atas($data,$upload);   
    public function foto_klinis_oklusal_rahang_bawah($data,$upload); 

    public function foto_klinis_before($data,$upload);   
    public function foto_klinis_after($data,$upload); 

    public function foto_ronsen_panoramik($data,$upload);   
}
