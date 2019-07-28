<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\FileRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function uploadAvatar(FileRequest $request)
    {
        $input = $request->validated();

        $file = $input['image'];
        $path = Storage::put('/files', $file);

        $user = auth()->user();
        Storage::delete($user->avatar_url);
        $user->avatar_url = $path;
        $user->save();

        return response()->success([
            'success' => true,
        ]);
    }

    public function getAllFiles()
    {
        $files = Storage::allFiles('/files');

        $filesUrl = [];

        foreach ($files as $file) {
            array_push($filesUrl, Storage::url($file));
        }
        return response()->success($filesUrl);
    }
}
