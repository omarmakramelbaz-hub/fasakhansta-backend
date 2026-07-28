<?php

namespace App\Interfaces;

interface ResturantProductRepositoryInterface
{
    public function getAllResturantProducts($request);
    public function getResturantProductById($resturant_productId);
    public function deleteResturantProduct($resturant_productId);
    public function createResturantProduct(array $resturant_productDetails);
    public function updateResturantProduct($resturant_productId, array $newDetails);
    public function deleteAllResturantProducts($ids);

}