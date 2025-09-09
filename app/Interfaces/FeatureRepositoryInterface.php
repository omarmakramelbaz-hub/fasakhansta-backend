<?php

namespace App\Interfaces;

interface FeatureRepositoryInterface 
{
    public function getAllFeatures($request);
    public function getFeatureById($featureId);
    public function deleteFeature($featureId);
    public function createFeature(array $featureDetails);
    public function updateFeature($featureId, array $newDetails);
    public function deleteAllFeatures($ids);

}