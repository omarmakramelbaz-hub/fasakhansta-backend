<?php

namespace App\Repositories;

use App\Interfaces\AboutRepositoryInterface;
use App\Models\About;
use App\Http\Traits\UploadImageTrait;

class AboutRepository implements AboutRepositoryInterface 
{
    use UploadImageTrait;

    public function getAllAbouts($request) 
    {
        $searchQuery = trim($request->query('search'));
       
        return About::where('title_'.app()->getLocale(), 'like', '%' . $request->search . '%')->when($request->query('from_date'), function($query, $from_date) {
                $query->where('created_at', '>=', $from_date);
            })->when($request->query('to_date'), function($query, $to_date) {
                $query->where('created_at', '<=', $to_date);
            })
            ->orderBy('id', 'desc')
            ->paginate(30);
    }

    public function getAboutById($aboutId) 
    {
        return About::findOrFail($aboutId);
    }

    public function deleteAbout($aboutId) 
    {
        // $about->destroy($aboutId);  
         $get_user = About::whereId($aboutId)->delete();
    }

    public function createAbout(array $aboutDetails) 
    {
        $about = About::create($aboutDetails);
       
        return $about;
    }

    public function updateAbout($aboutId, array $newDetails) 
    {
        $about = About::whereId($aboutId)->first();
        
        return $about->update($newDetails);
    }

    public function deleteAllAbouts($ids) 
    {
        $abouts= About::whereIn('id',explode(",",$ids))->delete();
    
        return $abouts;
    }
    
}