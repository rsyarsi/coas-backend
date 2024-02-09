<?php
namespace App\Repositories\Interfaces;

Interface AssesmentGroupRepositoryInterface{
    public function allAssesmentGroup();
    public function storeAssesmentGroup($data,$uuid);
    public function findAssesmentGroup($id);
    public function updateAssesmentGroup($data);  
}