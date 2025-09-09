<?php

namespace App\Interfaces;

interface CategoryTypeRepositoryInterface 
{
    public function getAllCategoryTypes($request);
    public function getCategoryTypeById($category_typeId);
    public function deleteCategoryType($category_typeId);
    public function createCategoryType(array $category_typeDetails);
    public function updateCategoryType($category_typeId, array $newDetails);
    public function deleteAllCategoryTypes($ids);

}