<?php

namespace App\Http\Requests\Dashboard\Trademark;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrademarkRequest extends FormRequest
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
            'admin_id' => 'required|exists:admins,id',
            'title_ar' => 'required|string|min:3|max:100',
            'trademark_image' => 'sometimes|nullable|image',
        ];
    }
}