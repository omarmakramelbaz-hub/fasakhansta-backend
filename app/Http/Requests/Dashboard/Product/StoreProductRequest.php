<?php

namespace App\Http\Requests\Dashboard\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'added_by'          => 'required|exists:users,id',
            'category_id'       => 'required|exists:categories,id',
            'subcategory_id'    => 'sometimes|nullable|exists:categories,id',
            'status'            => 'required|string|in:show,hide',
     ]  
        +
         ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store()
    {
         return [
            'name_ar'           => 'required|string|min:3|max:255|unique:products,name_ar',  

         ];
    }

    protected function update()
    {
         return [
            'name_ar'           => 'required|string|min:3|max:255|unique:products,name_ar,'.$this->product_id,  

         ];
    }
}