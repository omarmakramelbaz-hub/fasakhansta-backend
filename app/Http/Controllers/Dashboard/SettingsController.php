<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSettings;
use App\Http\Requests\Dashboard\UpdateSettingRequest;
use App\Http\Requests\Dashboard\AdvertiseRequest;
use App\Http\Traits\UploadImageTrait;

class SettingsController extends Controller
{
    use UploadImageTrait;

    function __construct()
    {
        $this->middleware('permission:setting-list', ['only' => ['index','update','headerImage','updateHeaderImage']]);
        $this->middleware('permission:paymob-list', ['only' => ['enviroSetting']]);
    }

    public function index(GeneralSettings $settings){
        return view('admin.settings', compact('settings'));
    }

    public function update(GeneralSettings $settings, UpdateSettingRequest $request){
        $settings->site_name = $request->input('site_name');
        $settings->email = $request->input('email');
        $settings->phone = $request->input('phone');
        $settings->policy_en = $request->input('policy_en');
        $settings->policy_ar = $request->input('policy_ar');
        $settings->about_en = $request->input('about_en');
        $settings->about_ar = $request->input('about_ar');
        $settings->service_fees = $request->input('service_fees');
        $settings->terms_en = $request->input('terms_en');
        $settings->terms_ar = $request->input('terms_ar');
        $settings->contact_text_en = $request->input('contact_text_en');
        $settings->contact_text_ar = $request->input('contact_text_ar');
        $settings->address = $request->input('address');
        $settings->km_price = $request->input('km_price');
        $settings->tax = $request->input('tax');
        $settings->vendor_tax = $request->input('vendor_tax');
        $settings->app_balance = $request->input('app_balance');
        $settings->googleplay_link = $request->input('googleplay_link');
        $settings->applestore_link = $request->input('applestore_link') ?? "";
        $settings->vendor_googleplay_link = $request->input('vendor_googleplay_link');
        $settings->vendor_applestore_link = $request->input('vendor_applestore_link') ?? "";
        $settings->delegate_googleplay_link = $request->input('delegate_googleplay_link');
        $settings->delegate_applestore_link = $request->input('delegate_applestore_link') ?? "";
        $settings->slider_title_en = $request->input('slider_title_en');
        $settings->slider_title_ar = $request->input('slider_title_ar');
        $settings->slider_text_en = $request->input('slider_text_en');
        $settings->slider_text_ar = $request->input('slider_text_ar');
        $settings->shipping_km_price = $request->input('shipping_km_price');
        $settings->shipping_min_price = $request->input('shipping_min_price');
        $settings->shipping_cancelled_block_no = $request->input('shipping_cancelled_block_no');
        $settings->app_banner_background_color = $request->input('app_banner_background_color');
        $settings->min_order_price = $request->input('min_order_price');

        if ($lfile = $request->file('logo')) {
            $settings->logo = $this->uploadImg($lfile, 'settings');
        }
        if ($file = $request->file('favicon')) {
            $settings->favicon = $this->uploadImg($file, 'settings');
        }
        if ($header = $request->file('header_image')) {
            $settings->header_image = $this->uploadImg($header, 'settings');
        }

        $settings->save();
        return redirect()->back()->with('success', trans('messages.UpdateSuccessfully'));
    }

    public function headerImage(GeneralSettings $settings){
        return view('admin.header-image', compact('settings'));
    }

    public function updateHeaderImage(GeneralSettings $settings, Request $request){
        $request->validate([
            'header_image' => 'required|image|max:10240',
        ]);

        $settings->header_image = $this->uploadImg($request->file('header_image'), 'settings');
        $settings->save();

        return redirect()->back()->with('success', 'تم تحديث صورة هيدر التطبيق بنجاح');
    }

    public function advertising(GeneralSettings $settings){
        return view('admin.advertising', compact('settings'));
    }

    public function update_advertising(GeneralSettings $settings, AdvertiseRequest $request){
        $settings->advertise_resturant_id = $request->input('advertise_resturant_id');

        if ($lfile = $request->file('advertise_image')) {
            $settings->advertise_image = $this->uploadImg($lfile, 'settings');
        }

        $settings->save();
        return redirect()->back()->with('success', trans('messages.UpdateSuccessfully'));
    }

    public function enviroSetting(GeneralSettings $settings){
        return view('admin.env-setting', compact('settings'));
    }

    public function updatePaymentActivation(Request $request, GeneralSettings $settings){
        if($request->input('wallet_card_activate')){
            $settings->wallet_card_activate = ($request->wallet_card_activate == 'on') ? 'true' : 'false';
        }else{
            $settings->wallet_card_activate = false;
        }
        if($request->input('payment_card_activate')){
            $settings->payment_card_activate = ($request->payment_card_activate == 'on') ? 'true' : 'false';
        }else{
            $settings->payment_card_activate = false;
        }
        $settings->save();
        return redirect()->back()->with('success',trans('messages.UpdateSuccessfully'));
    }

    public function updateEnv(){
        $env_update = $this->changeEnv([
            'PAYMOB_API_KEY'=> request('PAYMOB_API_KEY'),
            'PAYMOB_CARD_INTEGRATION_ID'=> request('PAYMOB_CARD_INTEGRATION_ID'),
            'PAYMOB_CARD_IFRAME_ID'=>request('PAYMOB_CARD_IFRAME_ID'),
            'PAYMOB_MOBILE_WALLET_INTEGRATION_ID'=> request('PAYMOB_MOBILE_WALLET_INTEGRATION_ID'),
        ]);
        if($env_update){
            return redirect()->back()->with('success',trans('main.UpdatedSuccessfully'));
        }
        return redirect()->back()->with('error',trans('main.error'));
    }

    protected function changeEnv($data = array()){
        if(count($data) > 0){
            $env = file_get_contents(base_path() . '/.env');
            $env = preg_split('/\s+/', $env);
            foreach((array)$data as $key => $value){
                foreach($env as $env_key => $env_value){
                    $entry = explode("=", $env_value, 2);
                    if($entry[0] == $key){
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        $env[$env_key] = $env_value;
                    }
                }
            }
            $env = implode("\n", $env);
            file_put_contents(base_path() . '/.env', $env);
            return true;
        }
        return false;
    }
}
