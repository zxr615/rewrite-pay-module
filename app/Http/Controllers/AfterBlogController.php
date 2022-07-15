<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;

/** Request 封装后 */
class AfterBlogController extends Controller
{
    public function store(BlogRequest $request)
    {
        return $this->success();
    }

    public function update(BlogRequest $request)
    {
        return $this->success();
    }

    public function delete(BlogRequest $request)
    {
        return $this->success();
    }
}
