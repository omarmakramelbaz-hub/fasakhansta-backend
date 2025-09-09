<?php

namespace App\Http\Requests\Api\Vendor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ApiResponses;


class CopyMenuRequest extends FormRequest
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
            'restraunt_product'           => 'required|array|min:1',
            'restraunt_product.*'           => 'required|exists:resturant_products,id',
            'resturant_id'         => 'required|exists:resturants,id',

        ];
    }
    
    public function attributes() {
        return [
            'resturant_id'               => trans('main.resturant'),
            'restraunt_product'             => trans('main.restraunt_product'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse($validator->errors()->first()));

    }
}
