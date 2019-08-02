<?php

namespace App\Http\Controllers\Api;

use App\Image;
use App\Jobs\CompressImage;
use App\Http\Requests\FileRequest;
use App\Http\Requests\AlbumRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function uploadAvatar(FileRequest $request)
    {
        $input = $request->validated();

        $file = $input['image'];

        $path = Storage::put('user-avatar', $file);

        $user = auth()->user();
        Storage::delete($user->avatar_url);
        $user->avatar_url = $path;
        $user->save();

        return response()->success([
            'success' => true,
        ]);
    }

    public function uploadAlbum(AlbumRequest $request)
    {
        $input = $request->validated();
        $images = $input['image'];

        $user = auth()->user();

        foreach ($images as $img) {
            $path = Storage::put('/images', $img);
            $image = new Image();
            $image->name = $img->getClientOriginalName();
            $image->mime_type = $img->getClientMimeType();
            $image->size = $img->getSize();
            $imagesize = getimagesize($img);
            $image->width = $imagesize[0];
            $image->height = $imagesize[1];
            $image->user_id = $user->id;
            $image->path = $path;
            $image->save();

            CompressImage::dispatch($path);
        }

        return response()->success([
            'success' => true,
        ]);
    }

    public function getAllFile()
    {
        $user = auth()->user();

        $images = Image::where('user_id', $user->id)->get();

        foreach ($images as $image) {
            $image->avatar_url = $image->imagePath();
        }

        return response()->success([
            'data' => $images
        ]);
    }

    public function removeFileAlbum(Request $request, int $id)
    {
        $user = auth()->user();

        $image = Image::where('id', $id)->where('user_id', $user->id)->first();

        if (is_null($image)) {
            return response()->notFound();
        }
        Storage::delete($image->path);
        $image->delete();

        return response()->noContent();
    }
}
