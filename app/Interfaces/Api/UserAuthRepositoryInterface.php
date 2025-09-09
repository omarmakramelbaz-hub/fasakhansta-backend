<?php

namespace App\Interfaces\Api;

interface UserAuthRepositoryInterface 
{
    public function loginUser(array $userDetails);
    public function profileUser($userId);
    public function deleteUser($userId);
    public function createUser(array $userDetails);
    public function updateUser($userId, array $newDetails);
    public function deleteAllUsers($ids);

}