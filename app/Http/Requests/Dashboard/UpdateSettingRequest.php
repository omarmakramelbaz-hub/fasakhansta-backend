<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'site_name' => 'required|string|min:3', 
            'email' => 'required|email',
            'phone' => 'required|numeric',
            // 'another_phone' => 'sometimes|nullable|numeric',
            'twitter_link' => 'sometimes|nullable|url',
            'facebook_link' => 'sometimes|nullable|url',
            'google_link' => 'sometimes|nullable|url',
            'instagram_link' => 'sometimes|nullable|url',
            'applestore_link' => 'nullable|url',
            'googleplay_link' => 'required|url',
            'vendor_applestore_link' => 'nullable|url',
            'vendor_googleplay_link' => 'required|url',
            'delegate_applestore_link' => 'nullable|url',
            'delegate_googleplay_link' => 'required|url',
            
            'wallet_card_activate' => 'sometimes|nullable',
            'payment_card_activate' => 'sometimes|nullable',
            'about_ar' => 'required|string|min:1|max:2400',
            'about_en' => 'required|string|min:1|max:2400',
            'slider_title_ar' => 'required|string|min:1|max:2400',
            'slider_title_en' => 'required|string|min:1|max:2400',
            'slider_text_ar' => 'required|string|min:1|max:2400',
            'slider_text_en' => 'required|string|min:1|max:2400',

            'logo' => 'sometimes|nullable|image',
            'favicon' => 'sometimes|nullable|image',
            'address' => 'required|string|min:3|max:1000',
            'policy_ar' => 'required|string|min:1|max:2400',
            'policy_en' => 'required|string|min:1|max:2400',
            'terms_ar' => 'required|string|min:1|max:2400',
            'terms_en' => 'required|string|min:1|max:2400',
            'contact_text_ar' => 'required|string|min:1|max:2400',
            'contact_text_en' => 'required|string|min:1|max:2400',
            'tax'=>'required|numeric',
            'vendor_tax'=>'required|numeric',
            'service_fees' => 'required|numeric',
            'min_order_price' => 'required|numeric',
            'shipping_km_price' => 'required|numeric',
            'shipping_min_price' => 'required|numeric',
            'shipping_cancelled_block_no'=>'required|numeric|min:1',
            'app_banner_background_color'=>'required',
            'default_0_1' => 'sometimes|nullable|numeric|min:0',
            'default_1_2' => 'sometimes|nullable|numeric|min:0',
            'default_2_3' => 'sometimes|nullable|numeric|min:0',

        ];
    }
}