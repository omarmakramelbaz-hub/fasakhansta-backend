<?php

namespace App\Interfaces;

interface ResturantRepositoryInterface 
{
    public function getAllResturants($request);
    public function getResturantById($resturantId);
    public function deleteResturant($resturantId);
    public function changeStatus($ResturantId, $request);
    public function createResturant(array $resturantDetails);
    public function updateResturant($resturantId, array $newDetails);
    public function deleteAllResturants($ids);

}