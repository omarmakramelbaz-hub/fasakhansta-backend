<?php

namespace App\Http\Requests\Api\Shipping;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ApiResponses;


class AcceptDelegateRequest extends FormRequest
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
            'order_id'=>'required|exists:orders,id',
            'delegate_id'=>'required|exists:users,id',
            'status'=>'required|in:accepted,declined'
            

        ];
    }
    
    public function attributes() {
        return [
            'order_id'=>__('main.order_id'),
            'delegate_id'=>__('main.delegate'),
            
            

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse($validator->errors()->first()));

    }
}
