<?php

namespace App\Repositories;

use App\Interfaces\CategoryTypeRepositoryInterface;
use App\Models\CategoryType;
use App\Http\Traits\UploadImageTrait;
class CategoryTypeRepository implements CategoryTypeRepositoryInterface 
{
    use UploadImageTrait;

    public function getAllCategoryTypes($request) 
    {
        $searchQuery = trim($request->query('search'));
       
        return CategoryType::where('title_'.app()->getLocale(), 'like', '%' . $request->search . '%')->when($request->query('from_date'), function($query, $from_date) {
                $query->where('created_at', '>=', $from_date);
            })->when($request->query('to_date'), function($query, $to_date) {
                $query->where('created_at', '<=', $to_date);
            })
            ->orderBy('id', 'desc')
            ->paginate(30);
    }

    public function getCategoryTypeById($category_typeId) 
    {
        return CategoryType::findOrFail($category_typeId);
    }

    public function deleteCategoryType($category_typeId) 
    {
         $get_user = CategoryType::whereId($category_typeId)->delete();
    }

    public function createCategoryType(array $category_typeDetails) 
    {
        $category_type = CategoryType::create($category_typeDetails);
        return $category_type;
    }

    public function updateCategoryType($category_typeId, array $newDetails) 
    {
        $category_type = CategoryType::whereId($category_typeId)->first();         
        return $category_type->update($newDetails);
    }

    public function deleteAllCategoryTypes($ids) 
    {
        $category_types= CategoryType::whereIn('id',explode(",",$ids))->delete();
    
        return $category_types;
    }
    
}