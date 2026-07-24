<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;
    public bool   $site_active;
    public string $logo;
    public string $favicon;
    public string $email;
    public string $phone;
    public string $min_order_price;
    public string $service_fees;
    public string $address;    
    public string $twitter_link;
    public string $facebook_link;
    public string $instagram_link;
    public string $google_link;
    public string $contact_text_ar;
    public string $contact_text_en;
    public string $wallet_card_activate;
    public string $payment_card_activate;
    public string $about_ar;
    public string $about_en;
    public string $applestore_link;
    public string $googleplay_link;
    
    public string $vendor_applestore_link;
    public string $vendor_googleplay_link;
    
    public string $delegate_applestore_link;
    public string $delegate_googleplay_link;

    public string $policy_ar;
    public string $policy_en;
    public string $terms_ar;
    public string $terms_en;
    public string $km_price;
    public string $vendor_tax;
    public string $tax;
    public string $app_balance;
    public string $advertise_resturant_id;
    public string $advertise_image;
    public string $slider_text_ar;
    public string $slider_text_en;
    public string $slider_title_ar;
    public string $slider_title_en;
    
    public string $shipping_km_price;
    public string $shipping_min_price;
    public string $shipping_cancelled_block_no;

   public string $app_banner_background_color;
   public string $delegate_vendor_small_info;

   public string $default_0_1;
   public string $default_1_2;
   public string $default_2_3;

    public string $min_wallet;
    public static function group(): string
    {
        return 'general';
    }
    
    public function policy(){
         $lang = app()->getLocale();
        $column = "policy_" . $lang;
        return $this->{$column};;
    }
     public function terms(){
         $lang = app()->getLocale();
        $column = "terms_" . $lang;
        return $this->{$column};;
    }
     public function contact_text(){
         $lang = app()->getLocale();
        $column = "contact_text_" . $lang;
        return $this->{$column};;
    }
     public function about(){
         $lang = app()->getLocale();
        $column = "about_" . $lang;
        return $this->{$column};;
    }
    
    public function slider_text(){
         $lang = app()->getLocale();
        $column = "slider_text_" . $lang;
        return $this->{$column};;
    }
     public function slider_title(){
         $lang = app()->getLocale();
        $column = "slider_title_" . $lang;
        return $this->{$column};;
    }
}
?>