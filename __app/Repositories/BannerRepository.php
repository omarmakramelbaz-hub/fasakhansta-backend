<?php

namespace App\Repositories;

use App\Interfaces\BannerRepositoryInterface;
use App\Models\Banner;
use App\Http\Traits\UploadImageTrait;

class BannerRepository implements BannerRepositoryInterface 
{
    use UploadImageTrait;

    public function getAllBanners($request) 
    {
        $searchQuery = trim($request->query('search'));
       
        return Banner::where('title_'.app()->getLocale(), 'like', '%' . $request->search . '%')->when($request->query('from_date'), function($query, $from_date) {
                $query->where('created_at', '>=', $from_date);
            })->when($request->query('to_date'), function($query, $to_date) {
                $query->where('created_at', '<=', $to_date);
            })
            ->orderBy('id', 'desc')
            ->paginate(30);
    }

    public function getBannerById($bannerId) 
    {
        return Banner::findOrFail($bannerId);
    }

    public function deleteBanner($bannerId) 
    {
        // $banner->destroy($bannerId);  
         $get_user = Banner::whereId($bannerId)->delete();
    }

    public function createBanner(array $bannerDetails) 
    {
        unset($bannerDetails['image']);
        $banner = Banner::create($bannerDetails);
        if(request()->hasFile('image') && request()->file('image')->isValid())
        {
            $this->convertImageToWebp(request()->image,$banner,'image','banners');
        }
        return $banner;
    }

    public function updateBanner($bannerId, array $newDetails) 
    {
        unset($newDetails['image']);
        $banner = Banner::whereId($bannerId)->first();
        if(request()->hasFile('image') && request()->file('image')->isValid())
        {
            $banner->clearMediaCollection('image');
            $this->convertImageToWebp(request('image'),$banner,'image','banners');
        }
        return $banner->update($newDetails);
    }

    public function deleteAllBanners($ids) 
    {
        $banners= Banner::whereIn('id',explode(",",$ids))->delete();
    
        return $banners;
    }
    
}