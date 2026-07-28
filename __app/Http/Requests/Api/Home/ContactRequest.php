<?php

namespace App\Http\Requests\Api\Home;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ApiResponses;


class ContactRequest extends FormRequest
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
            'name'           => 'required|string|min:2|max:100',
            'email'         => 'required|email',
            'message'        => 'required|min:2|string|max:255',
            'user_id'=>'nullable|exists:users,id'

        ];
    }
    
    public function attributes() {
        return [
            'name'               => trans('main.name'),
            'email'             => trans('main.email'),
            'message'            => trans('main.message'),
            'user_id'            => trans('main.user'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse($validator->errors()->first()));

    }
}
