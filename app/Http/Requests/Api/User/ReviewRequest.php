<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ApiResponses;


class ReviewRequest extends FormRequest
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
            'resturant_id'           => 'required|exists:resturants,id',
            'order_id'           => 'required|exists:orders,id',
            'rate'                     => 'required',

        ];
    }
    
    public function attributes() {
        return [
            'resturant_id'               => trans('main.resturant_id'),
            'order_id'               => trans('main.order_id'),
            'rate'               => trans('main.rate'),

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse($validator->errors()->first()));

    }
}
