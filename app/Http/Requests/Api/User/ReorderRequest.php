<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ApiResponses;


class ReorderRequest extends FormRequest
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
            'resturant_product_id'=>'required|array|min:1',
            'resturant_product_id.*'           => 'required|exists:resturant_products,id',
            'product_feature.*'                     => 'nullable|exists:product_features,id',
            // 'product_clean'                          => 'nullable|in:extra_clear,extra_clean,extra_vacuim',

        ];
    }
    
    public function attributes() {
        return [
            'resturant_product_id.*'               => trans('main.resturant_product_id'),
            'resturant_product_id'=>__('main.products')

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse($validator->errors()->first()));

    }
}
