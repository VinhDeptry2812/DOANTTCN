<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoraCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'string|required|unique:categories,name',
            'decription' =>'string|required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048'
        ];
    }
}
