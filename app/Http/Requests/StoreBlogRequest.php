<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'   => 'required|max:100',
            'content' => 'required|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'title.required'   => '标题不能为空',
            'content.required' => '内容不能为空'
        ];
    }

    /** 参数验证失败返回处理 */
    protected function failedValidation(Validator $validator): HttpResponseException
    {
        $actionMethod = $this->route()->getActionMethod() . 'FailedValidation';

        // 使用自定义错误格式
        if (method_exists($this, $actionMethod)) {
            $this->$actionMethod();
        }

        // 默认错误格式
        $err = $validator->errors()->first();

        throw new HttpResponseException(response()->json(['status' => 400, 'message' => $err], 400, [], JSON_UNESCAPED_UNICODE));
    }
}
