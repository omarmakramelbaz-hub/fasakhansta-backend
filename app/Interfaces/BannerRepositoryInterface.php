<?php

namespace App\Interfaces;

interface BannerRepositoryInterface 
{
    public function getAllBanners($request);
    public function getBannerById($bannerId);
    public function deleteBanner($bannerId);
    public function createBanner(array $bannerDetails);
    public function updateBanner($bannerId, array $newDetails);
    public function deleteAllBanners($ids);

}