<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreSlidearRequest extends FormRequest
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
            'title' => 'sometimes|nullable|string|min:3|max:200',
            'restraunt_id' => 'sometimes|nullable|exists:resturants,id',
            
        ]  
        +
         ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store()
    {
         return [
            'images'=>'required|array|min:1',
            'images.*' => 'required|image|mimes:png,jpeg,jpg,webp',

         ];
    }

    protected function update()
    {
         return [
            'images.*' => 'nullable|image|mimes:png,jpeg,jpg,webp',

         ];
    }
}