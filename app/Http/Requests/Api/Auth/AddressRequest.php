<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ApiResponses;
use Illuminate\Validation\Rule;

class AddressRequest extends FormRequest
{   use ApiResponses;
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
            // 'area_id'=>'required|integer|exists:areas,id',
            'area_name'=>'required|string|max:255',
            'apartment_no'=>'required|string|max:255',
            'floor_no'=>'nullable|string|max:255',
            'street_name'=>'required|string|max:255',
            'badge'=>'nullable|string|max:255',
            'address_name'=>'nullable|string|max:255',
            'mobile'=>'required|string|max:13',
            'lat'=>'required',
            'lng'=>'required',
            'type'=>'required|in:office,home,apartment',

    	];  
   }
    public function attributes() {
        return [
            'area_name'                  => trans('main.area_name'),
            'mobile'                => trans('main.mobile'),
            'apartment_no'                 => trans('main.apartment_no'),
            'floor_no'              => trans('main.floor_no'),
            'street_name'              => trans('main.street_name'),
            'badge'              => trans('main.badge'),
            'address_name'              => trans('main.address_name'),
            'type'              => trans('main.type'),
        ];
    }



    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse($validator->errors()->first()));

    }
}
