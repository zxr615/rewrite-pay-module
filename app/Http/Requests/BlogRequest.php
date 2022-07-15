<?php

namespace App\Http\Requests;

class BlogRequest extends BaseRequest
{
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }

    public function storeRules(): array
    {
        return [
            'title'   => 'required|max:100',
            'content' => 'required|max:1000'
        ];
    }

    public function storeMessages(): array
    {
        return [
            'title.required'   => '标题不能为空',
            'content.required' => '内容不能为空',
        ];
    }

    public function updateRules(): array
    {
        return [
            'id'      => 'required|integer',
            'title'   => 'max:100',
            'content' => 'max:1000',
        ];
    }

    public function updateMessages(): array
    {
        return [
            'id.required' => 'id不能为空',
        ];
    }

    public function deleteRules(): array
    {
        return [
            'id' => 'required|integer',
        ];
    }

    public function deleteMessages(): array
    {
        return [
            'id.required' => 'id不能为空',
        ];
    }

    public function deleteAuthorize(): bool
    {
        return false;
    }
}
