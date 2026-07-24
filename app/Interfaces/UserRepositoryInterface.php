<?php

namespace App\Interfaces;

interface UserRepositoryInterface 
{
    public function getAllUsers($request);
    public function getUserById($userId);
    public function deleteUser($userId);
    public function createUser(array $userDetails);
    public function updateUser($userId, array $newDetails);
    public function deleteAllUsers($ids);

}