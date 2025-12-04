<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BannerRequest extends FormRequest
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
            'position' => [
                'string',
                function ($attribute, $value, $fail) {
                    if ($value !== 'header-top') {
                        $exists = \App\Models\Banner::where('position', $value)->exists();
                        if ($exists) {
                            $fail('Position đã tồn tại.');
                        }
                    }
                }
            ],
        ];
    }
}
