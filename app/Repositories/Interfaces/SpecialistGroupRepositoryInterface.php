<?php
namespace App\Repositories\Interfaces;

Interface SpecialistGroupRepositoryInterface{
    public function allSpecialistGroup();
    public function storeSpecialistGroup($data,$uuid);
    public function findSpecialistGroup($id);
    public function updateSpecialistGroup($data);  
}