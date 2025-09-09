<?php

namespace App\Interfaces;

interface ProductRepositoryInterface 
{
    public function getAllProducts($request);
    public function getProductById($productId);
    public function deleteProduct($productId);
    public function createProduct(array $productDetails);
    public function updateProduct($productId, array $newDetails);
    public function deleteAllProducts($ids);

}