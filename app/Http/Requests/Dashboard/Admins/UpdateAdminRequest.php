<?php

namespace App\Http\Requests\Dashboard\Admins;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
            'name' => 'required|alpha_dash|min:3|max:50|unique:admins,name,'.$this->admin->id,
            'email' => 'required|email|unique:admins,email,'.$this->admin->id,
            'password' => 'sometimes|nullable|min:6|max:20',
            'roles_name' => 'required',
            'roles_name.*' => 'required|string',
        ];
    }
}