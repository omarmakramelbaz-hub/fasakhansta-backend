<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Http\Traits\UploadImageTrait;

class CategoryRepository implements CategoryRepositoryInterface 
{
    use UploadImageTrait;

    public function getAllCategorys($request) 
    {
        $searchQuery = trim($request->query('search'));
       
        return Category::where('name_'.app()->getLocale(), 'like', '%' . $request->search . '%')->when($request->query('parent'), function($query, $parent) {
                if($parent == 'parent'){
                    $query->whereNull('parent_id');
                }elseif($parent == 'sub'){
                    $query->whereNotNull('parent_id');
                }
            })->when($request->query('from_date'), function($query, $from_date) {
                $query->where('created_at', '>=', $from_date);
            })->when($request->query('to_date'), function($query, $to_date) {
                $query->where('created_at', '<=', $to_date);
            })
            ->orderBy('order', 'asc')
            ->paginate(30);
    }

    public function getCategoryById($categoryId) 
    {
        return Category::findOrFail($categoryId);
    }

    public function deleteCategory($categoryId) 
    {
         $get_user = Category::whereId($categoryId)->delete();
    }

    public function createCategory(array $categoryDetails) 
    {
        $category = Category::create($categoryDetails);
        return $category;
    }

    public function updateCategory($categoryId, array $newDetails) 
    {        
        $category = Category::whereId($categoryId)->first();      
        return $category->update($newDetails);
    }

    public function deleteAllCategorys($ids) 
    {
        $categorys= Category::whereIn('id',explode(",",$ids))->delete();
        return $categorys;
    }
    
}