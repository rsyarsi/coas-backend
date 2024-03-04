<?php
namespace App\Repositories\Interfaces;

Interface AssesmentGroupFinalRepositoryInterface{
    public function allAssesmentGroupFinal();
    public function viewallwithotpaging();
    public function storeAssesmentGroupFinal($data,$uuid);
    public function findAssesmentGroupFinal($id);
    public function updateAssesmentGroupFinal($data); 
}