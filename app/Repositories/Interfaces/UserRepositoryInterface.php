<?php
namespace App\Repositories\Interfaces;

Interface UserRepositoryInterface{
 
    public function storeUser($data);
    public function login($data);
    public function updateDateExpired($data,$access_token,$expired);
    public function getTokenData($data);
   
}