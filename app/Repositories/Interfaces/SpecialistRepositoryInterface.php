<?php
namespace App\Repositories\Interfaces;

Interface SpecialistRepositoryInterface{
    public function allSpecialist();
    public function storeSpecialist($data,$uuid);
    public function findSpecialist($id);
    public function updateSpecialist($data);  
}