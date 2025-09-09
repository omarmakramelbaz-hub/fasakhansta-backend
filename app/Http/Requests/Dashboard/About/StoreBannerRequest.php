<?php

namespace App\Http\Requests\Dashboard\About;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
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
            'added_by' => 'required|exists:users,id',
            'title_ar' => 'required|string|min:3|max:255',
            'title_en' => 'required|string|min:3|max:255',
            'status' => 'required|string|in:show,hide',
     ]  
        +
         ($this->isMethod('POST') ? $this->store() : $this->update());
    }

   protected function store()
    {
         return [
            'image' => 'required|mimes:png,jpeg,jpg,webp,svg',
         ];
    }

    protected function update()
    {
         return [
            'image' => 'sometimes|nullable|mimes:png,jpeg,jpg,webp,svg',
         ];
    }
}