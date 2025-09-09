<?php

namespace App\Interfaces;

interface SlotRepositoryInterface 
{
    public function getAllSlots($request);
    public function getSlotById($slotId);
    public function deleteSlot($slotId);
    public function createSlot(array $slotDetails);
    public function updateSlot($slotId, array $newDetails);
    public function deleteAllSlots($ids);

}