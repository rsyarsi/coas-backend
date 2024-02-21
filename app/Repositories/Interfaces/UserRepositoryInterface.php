<?php
namespace App\Repositories\Interfaces;

Interface UserRepositoryInterface{
 
    public function storeUser($data,$uuid);    
    public function updateData($data);
    public function login($data); 
    public function updateDateExpired($data,$access_token,$expired);
    public function getTokenData($data);    
    public function refreshToken();    
    public function profile($data);    
    public function showbyid($id);
    public function logout();    
    public function allUser();    
    public function allUserswithoutPaging();




   
}