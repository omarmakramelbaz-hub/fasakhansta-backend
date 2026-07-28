<?php

namespace App\Http\Requests\Dashboard\Blog;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'title_ar' => 'required|string|min:3',
            'description_ar' => 'sometimes|nullable|string|min:3',
            'short_description_ar' => 'required|string|min:3',
            'blog_image' => 'sometimes|nullable|mimes:png,jpeg,jpg,webp,svg',
            'status' => 'required|in:show,hide',
        
     ]  
        +
         ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store()
    {
         return [
            'blog_cover' => 'required|mimes:png,jpeg,jpg,webp,svg',
         ];
    }

    protected function update()
    {
         return [
            'blog_cover' => 'sometimes|nullable|mimes:png,jpeg,jpg,webp,svg',
         ];
    }
}