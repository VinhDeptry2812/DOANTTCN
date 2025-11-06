<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditCategoryRequest extends FormRequest
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
            Rule::unique('categories', 'name')->ignore($this->id),
            'decription' =>'string',
            'image' => 'image|mimes:jpg,png,jpeg,gif|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên danh mục không được để trống!',
            'name.unique' => 'Tên danh mục đã tồn tại!',
            'image.image' => 'File phải là ảnh!',
        ];
    }
}
