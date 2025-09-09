<?php

namespace App\Http\Requests\Dashboard\Gate;

use Illuminate\Foundation\Http\FormRequest;

class StoreSlotRequest extends FormRequest
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
            'admin_id' => 'sometimes|nullable|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'gate_id' => 'required|exists:gates,id',
     ]  
        +
         ($this->isMethod('POST') ? $this->store() : $this->update());
    }

   protected function store()
    {
         return [
            // 'blog_cover' => 'required|mimes:png,jpeg,jpg,webp,svg',
            'title_ar' => 'required|string|min:1|max:255|unique:slots,title_ar',  
            'title_en' => 'required|string|min:1|max:255|unique:slots,title_en',  

         ];
    }

    protected function update()
    {
         return [
            // 'blog_cover' => 'sometimes|nullable|mimes:png,jpeg,jpg,webp,svg',
            'title_ar' => 'required|string|min:1|max:255|unique:slots,title_ar,'.$this->id,  
            'title_en' => 'required|string|min:1|max:255|unique:slots,title_en,'.$this->id,  

         ];
    }
}