<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        $actionMethod = $this->route()->getActionMethod() . 'Authorize';

        if (!method_exists($this, $actionMethod)) {
            return true;
        }

        return $this->$actionMethod();
    }

    public function rules(): array
    {
        $actionMethod = $this->route()->getActionMethod() . 'Rules';

        if (!method_exists($this, $actionMethod)) {
            return [];
        }

        return $this->$actionMethod();
    }

    public function messages(): array
    {
        $actionMethod = $this->route()->getActionMethod() . 'Messages';

        if (!method_exists($this, $actionMethod)) {
            return [];
        }

        return $this->$actionMethod();
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

    /** 请求授权验证未通过时(authorize方法未通过时) */
    protected function failedAuthorization()
    {
        $actionMethod = $this->route()->getActionMethod() . 'FailedAuthorization';

        if (method_exists($this, $actionMethod)) {
            return $this->$actionMethod();
        }

        throw new HttpResponseException(response()->json(['status' => 403, 'message' => '您没有权限访问'], 403, [], JSON_UNESCAPED_UNICODE));
    }
}
