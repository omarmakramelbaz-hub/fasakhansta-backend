<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ApiResponses;


class LoginRequest extends FormRequest
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
            // 'country_code'     => 'required|numeric',
            // 'mobile'           =>'required|numeric|regex:/[0-9]{7}/',
            'mobile'           =>'required',
            'password'         => 'required',
            'fcm_id'           =>'sometimes|nullable|string',
            'account_type'     => 'required|string|in:delegate,vendor',
        ];
    }
    
    public function attributes() {
        return [
            'mobile'           => trans('main.mobile'),
            'password'         => trans('main.password'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse($validator->errors()->first()));

    }
}
