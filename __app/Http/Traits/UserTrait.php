<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Banner;
trait UserTrait
{
    public function send_otp(){
        // mt_rand(1111,9999)
        $otp="1234";
        return $otp;
    }
    
    function generatePassword($length = 16, $includeUppercase = true, $includeNumbers = true, $includeSpecialChars = false) {
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        $specialChars = '!@#$%^&*()_+-=[]{}|;:,.<>?';

        $characters = $lowercase;
        if ($includeUppercase) {
            $characters .= $uppercase;
        }
        if ($includeNumbers) {
            $characters .= $numbers;
        }
        if ($includeSpecialChars) {
            $characters .= $specialChars;
        }

        return substr(str_shuffle($characters), 0, $length);
    }
    
}