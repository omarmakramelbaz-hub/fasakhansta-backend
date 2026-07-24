<?php

namespace App\Http\Requests\Api\Home;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ApiResponses;


class SubscripeCouponRequest extends FormRequest
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
            // 'count'           => 'required|numeric|min:1|max:100',
            'coupon_wheel_id'=>'required|exists:coupon_wheels,id',

        ];
    }
    
    public function attributes() {
        return [
            'coupon_wheel_id'               => trans('main.coupon_wheel'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse($validator->errors()->first()));

    }
}
