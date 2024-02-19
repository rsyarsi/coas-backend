<?php

namespace App\Repositories\Interfaces;

interface EmrProstodontieRepositoryInterface
{
    public function createwaktuperawatan($data, $uuid);
    // public function createbehaviorrating($data);
    public function findwaktuperawatan($data);
    public function updatewaktuperawatan($data);
    public function viewemrbyRegOperator($data);
    public function logbookcreate($data);
    public function logbookupdate($data);    
    public function logbookdelete($data);  
    public function findlogbookbyId($data);
    public function findlogbookAll($data);
    public function validatelecture($data); 
}
