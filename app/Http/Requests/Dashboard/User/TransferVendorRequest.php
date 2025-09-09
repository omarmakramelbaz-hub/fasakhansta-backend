<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransferVendorRequest extends FormRequest
{
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
            // 'name.*' => ['required','min:2', 'max:130'],
            // 'mobile.*' => ['required','numeric','digits:10'],
            // 'password.*'=>['required'],
            // 'area_id.*'=>['required','exists:areas,id'],
            // 'resturant_name'=>['required','string','max:255']
     	]  
        +
         ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store()
    {
         return [
            // 'password' => 'required|string|min:6|max:20',
         ];
    }

    protected function update()
    {
         return [
            // 'password' => 'sometimes|nullable|string|min:6|max:20',
         ];
    }
}
