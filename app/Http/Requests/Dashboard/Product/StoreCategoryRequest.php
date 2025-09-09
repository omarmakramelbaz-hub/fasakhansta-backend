<?php

namespace App\Http\Requests\Dashboard\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'added_by'   => 'required|exists:users,id',
            'parent_id'  => 'sometimes|nullable|exists:categories,id',
            'status'     => 'required|string|in:show,hide',
     ]  
        +
         ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store()
    {
         return [
            'name_ar' => 'required|string|min:3|max:255',  
            'name_en' => 'required|string|min:3|max:255',  

         ];
    }

    protected function update()
    {
         return [
            'name_ar' => 'required|string|min:3|max:255',  
            'name_en' => 'required|string|min:3|max:255',  
         ];
    }
}