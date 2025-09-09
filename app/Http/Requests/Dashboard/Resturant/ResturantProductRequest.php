<?php

namespace App\Http\Requests\Dashboard\Resturant;

use Illuminate\Foundation\Http\FormRequest;

class ResturantProductRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'resturant_id' => 'required|exists:resturants,id',
            'product_id'=>'required|exists:products,id',
            'product_name' => 'required|string|min:3|max:255',
            'product_price'=>'required|min:0',
            'product_description'=>'sometimes|nullable|string|min:3|max:500',
            'product_image'=>request()->method=='post'?'required|image|mimes:png,jpg,jpeg,webp,svg':'nullable|image|mimes:png,jpg,jpeg,webp,svg',
        ];
    }
}