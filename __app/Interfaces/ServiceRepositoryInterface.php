<?php

namespace App\Interfaces;

interface ServiceRepositoryInterface 
{
    public function getAllServices($request);
    public function getServiceById($serviceId);
    public function deleteService($serviceId);
    public function createService(array $serviceDetails);
    public function updateService($serviceId, array $newDetails);
    public function deleteAllServices($ids);

}