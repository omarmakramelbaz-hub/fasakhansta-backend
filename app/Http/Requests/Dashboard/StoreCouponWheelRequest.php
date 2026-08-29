<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponWheelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'added_by' => 'required|exists:users,id',
            'name' => 'required|string|min:3|max:200',
            'restraunt_id'=>'required|array|min:1',
            'restraunt_id.*' => 'sometimes|nullable|exists:resturants,id',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after:start_date',
            'price'=>'required|numeric|min:1',
            'prize_amount'=>'nullable|numeric|min:0',
        ]
        +
         ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store()
    {
         return [
            'images'=>'required|image|mimes:png,jpeg,jpg,webp',
         ];
    }

    protected function update()
    {
         return [
            'images' => 'nullable|image|mimes:png,jpeg,jpg,webp',
         ];
    }
}
