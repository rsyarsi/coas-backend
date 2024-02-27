<?php

namespace App\Repositories\Interfaces;

interface EmrKonservasiRepositoryInterface
{
    public function createwaktuperawatan($data, $uuid);
    // public function createbehaviorrating($data);
    public function findwaktuperawatan($data);    
    public function viewemrbyRegOperator($data); 
    public function updatewaktuperawatan($data);

    
    // jobs - 
    public function createjob($data);   
    public function updatejob($data);    
    public function deletejob($data);   
    public function showbyidjob($data);      
    public function showalljob($data);   
    public function verifydpk($data);  
}
