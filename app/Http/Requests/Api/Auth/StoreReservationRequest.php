<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ApiResponses;

class StoreReservationRequest extends FormRequest
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
            'gate_id'                 => 'required|numeric|exists:gates,id',
            'slot_id'                 => 'required|numeric|exists:slots,id',
            'user_id'                 => 'sometimes|nullable|numeric|exists:usres,id',
            // 'car_images'              =>'sometimes|nullable|array',
            // 'car_images.*'            =>'image',
            'notes'=>'nullable',
        ];
    }
    
    public function attributes() {
        return [
            'gate_id'                 => trans('main.gate_id'),
            'slot_id'                 => trans('main.slot_id'),
            'user_id'                 => trans('main.user_id'),
            'car_images'              =>trans('main.car_images')
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse($validator->errors()->first()));

    }
}
