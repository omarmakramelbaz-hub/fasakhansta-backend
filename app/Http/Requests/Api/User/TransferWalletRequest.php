<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ApiResponses;
use Carbon\Carbon;

class TransferWalletRequest extends FormRequest
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
            'mobile'             =>'required|exists:users,mobile',
            'amount'            =>'required|numeric|min:1|max:5000',
            'account_type'       =>'required|in:user,vendor,delegate',
            

        ];
    }
    
    public function attributes() {
        return [
            'amount'               => trans('main.amount'),
            'mobile'               => trans('main.mobile'),
            'account_type'               => trans('main.account_type'),

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse($validator->errors()->first()));

    }
}
