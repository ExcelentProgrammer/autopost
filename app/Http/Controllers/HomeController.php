<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Jobs\AutoPostJob;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    use BaseController;

    function index(PostCreateRequest $request): JsonResponse
    {
        Post::query()->create($request->validated());

        $file = Storage::putFile("posts", $request->file("file"));
        $file_path = Storage::path($file);

        AutoPostJob::dispatch(title: $request->input("title"), file: $file_path);
        return $this->success(message: __("post:create"));
    }
}
