<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'id'      => 'required|integer',
            'title'   => 'max:100',
            'content' => 'max:1000'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required'   => 'id不能为空',
        ];
    }
}
