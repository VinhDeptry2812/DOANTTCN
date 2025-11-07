<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherRequest extends FormRequest
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
            'code' => 'required|string|unique:vouchers,code,' . $this->route('voucher'),
            'name' => 'required|string|max:255',
            'type' => 'required|in:percent,amount',
            'value' => 'required|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'min_order_value' => 'required|numeric|min:0',
            'usage_limit' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Mã voucher là bắt buộc.',
            'code.unique' => 'Mã voucher đã tồn tại.',
            'name.required' => 'Tên voucher là bắt buộc.',
            'type.required' => 'Loại voucher là bắt buộc.',
            'type.in' => 'Loại voucher không hợp lệ.',
            'value.required' => 'Giá trị giảm là bắt buộc.',
            'value.numeric' => 'Giá trị giảm phải là số.',
            'value.min' => 'Giá trị giảm phải lớn hơn 0.',
            'max_discount.numeric' => 'Giá trị tối đa phải là số.',
            'max_discount.min' => 'Giá trị tối đa phải >= 0.',
            'min_order_value.required' => 'Giá trị đơn hàng tối thiểu là bắt buộc.',
            'min_order_value.numeric' => 'Giá trị đơn hàng tối thiểu phải là số.',
            'usage_limit.required' => 'Số lượt sử dụng là bắt buộc.',
            'usage_limit.integer' => 'Số lượt sử dụng phải là số nguyên.',
            'usage_limit.min' => 'Số lượt sử dụng phải >= 1.',
            'start_date.required' => 'Ngày bắt đầu là bắt buộc.',
            'end_date.required' => 'Ngày kết thúc là bắt buộc.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
        ];
    }
}
