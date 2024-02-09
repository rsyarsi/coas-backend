<?php
namespace App\Repositories\Interfaces;

Interface StudentRepositoryInterface{
    public function allStudent();
    public function storeStudent($data,$uuid);
    public function findStudent($id);     
    public function updateStudent($data);  
}