<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdvertisingRequest extends FormRequest
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
            'from_date' => 'required',
            'to_date' => 'required|after_or_equal:' . date(DATE_ATOM),
            'resturant_id' => 'required|exists:resturants,id',
            
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