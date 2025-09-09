<?php

namespace App\Http\Requests\Dashboard\Gate;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'admin_id' => 'sometimes|nullable|exists:admins,id',
            'type' => 'required|string|in:normal,disability',        
     ]  
        +
         ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store()
    {
         return [
            'image' => 'required|image|mimes:png,jpeg,jpg,webp,svg',
            'title_ar' => 'required|string|min:3|max:255|unique:services,title_ar',  
            'title_en' => 'required|string|min:3|max:255|unique:services,title_en',  

         ];
    }

    protected function update()
    { 
        // dd($this->service);
         return [
            'image' => 'sometimes|nullable|image|mimes:png,jpeg,jpg,webp,svg',
            'title_ar' => 'required|string|min:3|max:255|unique:services,title_ar,'.$this->service?->id,  
            'title_en' => 'required|string|min:3|max:255|unique:services,title_en,'.$this->service?->id,  

         ];
    }
}