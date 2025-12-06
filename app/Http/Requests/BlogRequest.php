<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title'        => 'required|string|max:255',
            'thumbnail'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content'      => 'required|string',
            'category_id'  => 'required|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required'        => 'Vui lòng nhập tiêu đề bài viết.',
            'title.max'             => 'Tiêu đề không được vượt quá 255 ký tự.',

            'thumbnail.image'       => 'Thumbnail phải là một file ảnh hợp lệ.',
            'thumbnail.mimes'       => 'Thumbnail chỉ chấp nhận các định dạng: jpg, jpeg, png, webp.',
            'thumbnail.max'         => 'Kích thước ảnh tối đa là 2MB.',

            'content.required'      => 'Vui lòng nhập nội dung bài viết.',

            'category_id.required'  => 'Vui lòng chọn danh mục cho bài viết.',
            'category_id.exists'    => 'Danh mục được chọn không tồn tại.',
        ];
    }
}
