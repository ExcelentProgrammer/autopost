<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Jobs\AutoPostJob;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    use BaseController;

    function index(PostCreateRequest $request): JsonResponse
    {

        if ($request->files->has("file")) {
            $file = $request->file("file");
        } else {
            $file = $request->input("fileUrl");
        }
        Post::query()->create([
            "title" => $request->input("title"),
            "file" => $file
        ]);

        if ($request->files->has("file")) {
            $file = Storage::putFile("posts", $request->file("file"));
        } else {
            $remoteUrl = $request->input("fileUrl");
            $fileContents = file_get_contents($remoteUrl);
            $filename = 'downloaded_file_' . time() . '.jpg';
            $file = 'public/' . $filename;
            Storage::put($file, $fileContents);
        }

        $file_path = Storage::path($file);

        AutoPostJob::dispatch(title: $request->input("title"), file: $file_path);
        return $this->success(message: __("post:create"));

    }
}
