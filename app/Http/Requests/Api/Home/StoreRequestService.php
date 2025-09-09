<?php

namespace App\Http\Requests\Api\Home;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ApiResponses;

class StoreRequestService extends FormRequest
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
            'address'                  => 'required|string|min:2',
            'description'              => 'required|string|min:2',
            'upload_image'         => 'sometimes|nullable|file|image|mimes:png,svg,jpg,webp',
        ];
    }
    
    public function attributes() {
        return [
            'address'                  => trans('main.address'),
            'description'              => trans('main.description'),
            'upload_image'         => trans('main.upload_image'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse($validator->errors()->first()));

    }
}
