<?php

namespace App\Repositories;

use App\Interfaces\FeatureRepositoryInterface;
use App\Models\Feature;
use App\Http\Traits\UploadImageTrait;

class FeatureRepository implements FeatureRepositoryInterface 
{
    use UploadImageTrait;

    public function getAllFeatures($request) 
    {
        $searchQuery = trim($request->query('search'));
       
        return Feature::where('title_'.app()->getLocale(), 'like', '%' . $request->search . '%')->when($request->query('from_date'), function($query, $from_date) {
                $query->where('created_at', '>=', $from_date);
            })->when($request->query('to_date'), function($query, $to_date) {
                $query->where('created_at', '<=', $to_date);
            })
            ->orderBy('id', 'desc')
            ->paginate(30);
    }

    public function getFeatureById($featureId) 
    {
        return Feature::findOrFail($featureId);
    }

    public function deleteFeature($featureId) 
    {
        // $feature->destroy($featureId);  
         $get_user = Feature::whereId($featureId)->delete();
    }

    public function createFeature(array $featureDetails) 
    {
       unset($featureDetails['image']);
        $feature = Feature::create($featureDetails);
        if(request()->hasFile('image') && request()->file('image')->isValid())
        {
            $this->convertImageToWebp(request()->image,$user,'image','features');
        }
        return $feature;
    }

    public function updateFeature($featureId, array $newDetails) 
    {
        unset($newDetails['image']);
        $feature = Feature::whereId($featureId)->first();
        if(request()->hasFile('image') && request()->file('image')->isValid())
        {
            $feature->clearMediaCollection('image');
            $this->convertImageToWebp(request('image'),$feature,'image','features');
        }
        return $feature->update($newDetails);
    }

    public function deleteAllFeatures($ids) 
    {
        $features= Feature::whereIn('id',explode(",",$ids))->delete();
    
        return $features;
    }
    
}