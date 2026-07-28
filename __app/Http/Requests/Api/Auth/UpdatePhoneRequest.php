<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ApiResponses;


class UpdatePhoneRequest extends FormRequest
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
            'current_password' => 'required',
            'mobile' => 'required|numeric|digits:10',

        ];
    }
    
    public function attributes() {
        return [
            'mobile'           => trans('main.mobile'),
            'current_password'         => trans('main.current_password'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
                        if (request()->wantsJson() || request()->is('api/*')) {

        throw new HttpResponseException($this->errorResponse($validator->errors()->first()));
                        }
    }
}
