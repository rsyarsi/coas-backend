<?php
namespace App\Repositories\Interfaces;

Interface YearRepositoryInterface{
    public function allYears();    
    public function allYearswithoutPaging();

    public function storeYears($data,$uuid);
    public function findYears($id);
    public function updateYears($data); 
    public function destroyYears($id);
}