<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Http\Traits\UploadImageTrait;
use App\Models\ProductFeature;

class ProductRepository implements ProductRepositoryInterface 
{
    use UploadImageTrait;

    public function getAllProducts($request) 
    {
        $searchQuery = trim($request->query('search'));
       
        return Product::when($request->query('category'), function($query, $category) {
                $query->where('category_id', $category);
            })->when($request->query('subcategory'), function($query, $subcategory) {
                $query->where('subcategory_id', $subcategory);
            })->where('name_'.app()->getLocale(), 'like', '%' . $request->search . '%')->when($request->query('from_date'), function($query, $from_date) {
                $query->where('created_at', '>=', $from_date);
            })->when($request->query('to_date'), function($query, $to_date) {
                $query->where('created_at', '<=', $to_date);
            })
            ->orderBy('id', 'desc')
            ->paginate(30);
    }

    public function getProductById($productId) 
    {
        return Product::findOrFail($productId);
    }

    public function deleteProduct($productId) 
    {
         $get_user = Product::whereId($productId)->delete();
    }

    public function createProduct(array $productDetails) 
    {
        unset($productDetails['product_features']);
        $product = Product::create($productDetails);
        $product->name_en = $product->name_ar;
        $product->save();
        if(request('product_features')){
            if(count(request('product_features')) > 0){
                for($i=0;$i<count(request('product_features'));$i++){
                    ProductFeature::create([
                        'added_by' => $product->added_by,
                        'product_id' => $product->id,
                        'name' => request('product_features')[$i],
                    ]);
                }
            }
        }
        return $product;
    }

    public function updateProduct($productId, array $newDetails) 
    {
        unset($newDetails['product_features']);
        $product = Product::whereId($productId)->first();      
        $old_service = $product->product_features()->pluck('name')->toArray();
        
        if(request('product_features')){
          
            if(count(request('product_features')) > 0){
               $product->product_features()->delete();
               $ser=request('product_features');
                // dd($ser);
                for($i=0;$i<count($ser);$i++){
                        ProductFeature::create([
                            'added_by' => $product->added_by,
                            'product_id' => $product->id,
                            'name' => $ser[$i],
                        ]);
                   
                   
                }
            }
        } 
        unset($newDetails['old_service']);
        unset($newDetails['product_features']);
        unset($newDetails['product_id']);
        
        return $product->update($newDetails);
    }

    public function deleteAllProducts($ids) 
    {
        $products= Product::whereIn('id',explode(",",$ids))->delete();
    
        return $products;
    }
    
}