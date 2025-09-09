<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ApiResponses;

class UpdateUserRequest extends FormRequest
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
            'name'                  => 'required|string|min:2|max:150',
            // 'country_code'          => 'required|numeric',
            // 'mobile'                =>'required|numeric|unique:users,mobile,'.auth()->guard('api')->user()->id,
            'email'                 =>'required|email',
            'area_id'               =>'sometimes|nullable|exists:areas,id',
            'profile_image'         => 'sometimes|nullable|file|image|mimes:png,svg,jpg,webp',
            'fcm_id'                =>'sometimes|nullable|string',
        ];
    }
    
    public function attributes() {
        return [
            'name'                  => trans('main.name'),
            'mobile'                => trans('main.mobile'),
            'email'                 => trans('main.email'),
            'area_id'                 => trans('main.area_id'),
            'profile_image'         => trans('main.profile_image'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse($validator->errors()->first()));

    }
     protected function prepareForValidation()
    {
        $this->merge([
            'mobile' => ltrim($this->mobile,0),
        ]);
    }
}
