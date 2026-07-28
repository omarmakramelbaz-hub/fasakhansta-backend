<?php

namespace App\Interfaces;

interface AboutRepositoryInterface 
{
    public function getAllAbouts($request);
    public function getAboutById($aboutId);
    public function deleteAbout($aboutId);
    public function createAbout(array $aboutDetails);
    public function updateAbout($aboutId, array $newDetails);
    public function deleteAllAbouts($ids);

}