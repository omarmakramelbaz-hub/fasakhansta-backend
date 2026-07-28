<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ApiResponses;

class PendingVendorRequest extends FormRequest
{
  use ApiResponses;

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
            'type'          =>'required|in:vendor,delegate', 
            'email'                 => 'required|email',
            'full_name'             => 'required|string|min:2|max:150',
            'owner_name'            =>request()->type=='vendor'?'required|string|min:2|max:50':'nullable|string|min:2|max:50',
            'branches_no'           =>request()->type=='vendor'?'required|numeric|min:1':'nullable|numeric|min:0',
            'national_id'           =>'required|unique:pending_vendors,national_id,'.request()->id.'|numeric|digits:14',
            'commercial_registration_no' =>request()->type=='vendor'?'required|numeric':'nullable',
            'driving_license_no'    =>request()->type=='delegate'?'required|numeric':'nullable',
            'tax_no' =>request()->type=='vendor'?'required|numeric':'nullable',
            'location'    =>request()->type=='delegate'?'required|string|min:2|max:255':'nullable|string|min:2|max:255',
            'mobile'                =>'required|numeric|regex:/[0-9]{7}/',
            'another_mobile'                =>'sometimes|nullable|numeric|regex:/[0-9]{7}/',
            'national_id_image'           =>'nullable|image|mimes:png,jpg,webp',
            'commercial_registration_no_image' =>request()->type=='vendor'?'nullable|image|mimes:png,jpg,webp':'nullable|image|mimes:png,jpg,webp5',
            'driving_license_image'    =>request()->type=='delegate'?'nullable|image|mimes:png,jpg,webp':'nullable|image|mimes:png,jpg,webp',
            'tax_no_image' =>request()->type=='vendor'?'nullable|image|mimes:png,jpg,webp':'nullable|image|mimes:png,jpg,webp',
            'vodafone_cash_mobile'=>'required|numeric|regex:/[0-9]{7}/',
            
        ];
    }
    
    public function attributes() {
        return [
            'type'                  => trans('main.type'),
            'mobile'                => trans('main.mobile'),
            'another_mobile'                 => trans('main.another_mobile'),
            'full_name'              => request()->type == 'delegate'? __('main.full_name') : __('main.vendor_name'),
            'owner_name'                  => trans('main.owner_name'),
            'branches_no'                => trans('main.branches_no'),
            'national_id'                 => trans('main.national_id'),
            'commercial_registration_no'              => trans('main.commercial_registration_no'),
            'driving_license_no'                  => trans('main.driving_license_no'),
            'tax_no'                => trans('main.tax_no'),
            'location'                 => trans('main.location'),
            'national_id_image'                  => trans('main.national_id_image'),
            'commercial_registration_no_image'                => trans('main.commercial_registration_no_image'),
            'driving_license_image'                 => trans('main.driving_license_image'),
            'tax_no_image'              => trans('main.tax_no_image'),
            'vodafone_cash_mobile'              => trans('main.vodafone_cash_mobile'),
        ];
    }

  

    protected function prepareForValidation()
    {
        $this->merge([
            'mobile' => ltrim($this->mobile,0),
        ]);
    }
}
