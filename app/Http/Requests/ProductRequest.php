<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|min:1|max:255',
            'price' => 'required|numeric',
            'description' => 'required|min:1|max:255',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return[
            'name.required'=>'Name Is required',
            'description.required'=>'Description Is required',
            'price.required'=>'Price is required',
            'img.required'=>'Main Image is required'
        ];
    }
}
