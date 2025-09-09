<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ApiResponses;

class RequestServiceRequest extends FormRequest
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
            'ticket_id'        => 'required|numeric|exists:tickets,id',
            'service_id'       => 'required|numeric|exists:services,id',
            'notes'            => 'nullable|string',
            'user_mobile'      => 'required|string',
        ];
    }
    
    public function attributes() {
        return [
            'ticket_id'        => trans('main.ticket'),
            'service_id'       => trans('main.service'),
            'notes'            => trans('main.notes'),
            'user_mobile'      => trans('main.user_mobile'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse($validator->errors()->first()));

    }
}
