<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteBlogRequest;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Http\Request;

class BeforeBlogController extends Controller
{
    public function store(StoreBlogRequest $request)
    {
        return $this->success();
    }

    public function update(UpdateBlogRequest $request)
    {
    }

    public function delete(DeleteBlogRequest $request)
    {
        return $this->success();
    }
}
