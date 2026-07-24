<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ApiResponses;
use Carbon\Carbon;

class OrderRequest extends FormRequest
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
            'user_address_id'           => 'required|exists:user_address,id',
            'schedule_date'             =>  request()->order_type!='default'?'nullable|date_format:Y-m-d H:i':'nullable|date_format:Y-m-d H:i|after:'.Carbon::now()->format('Y-m-d H:i'),
            'payment_type'              => 'nullable|in:online,cash,v_cash,wallet',
            'delivery_price'            =>'required',
            

        ];
    }
    
    public function attributes() {
        return [
            'user_address_id'               => trans('main.user_address_id'),
            'schedule_date'               => trans('main.schedule_date'),
            'payment_type'               => trans('main.payment_type'),
            'delivery_price'               => trans('main.delivery_price'),

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse($validator->errors()->first()));

    }
}
