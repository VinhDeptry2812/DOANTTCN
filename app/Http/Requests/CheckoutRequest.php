<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'name'   => 'required|string|min:2|max:100',
            'phone'  => 'required|numeric|digits_between:9,12',
            'email'  => 'nullable|email|max:150',
            'address' => 'required|min:5|max:255',
            'decription'      => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Họ và tên không được để trống',
            'name.string'   => 'Họ và tên phải là chữ',
            'name.min'      => 'Họ và tên ít nhất :min ký tự',
            'name.max'      => 'Họ và tên tối đa :max ký tự',

            'phone.required' => 'Số điện thoại không được để trống',
            'phone.numeric'  => 'Số điện thoại phải là số',
            'phone.digits_between' => 'Số điện thoại phải từ :min đến :max chữ số',

            'email.email'    => 'Email không hợp lệ',
            'email.max'      => 'Email tối đa :max ký tự',

            'address.required' => 'Địa chỉ không được để trống',
            'address.min'      => 'Địa chỉ ít nhất :min ký tự',
            'address.max'      => 'Địa chỉ tối đa :max ký tự',
        ];
    }
}
