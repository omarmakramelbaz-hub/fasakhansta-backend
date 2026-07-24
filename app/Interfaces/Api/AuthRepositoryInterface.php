<?php

namespace App\Interfaces\Api;

interface AuthRepositoryInterface 
{
    public function login(array $Details);
    public function profile($Id);
    public function delete($Id);
    public function create(array $Details);
    public function update($Id, array $newDetails);
    public function deleteAlls($ids);

}