<?php

namespace App\Jobs;

use App\User;
use App\Image;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UploadAlbum implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $images;
    private $user;

    public function __construct($images, User $user)
    {
        $this->images = $images;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo 'upload album' . count($this->images) . "\n";

        // foreach ($this->images as $img) {
        //     $path = Storage::put('/images', $img);
        //     $image = new Image();
        //     $image->name = $img->getClientOriginalName();
        //     $image->mime_type = $img->getClientMimeType();
        //     $image->size = $img->getSize();
        //     $imagesize = getimagesize($img);
        //     $image->width = $imagesize[0];
        //     $image->height = $imagesize[1];
        //     $image->user_id = $this->user->id;
        //     $image->path = $path;
        //     $image->save();

        //     CompressImage::dispatch($path)
        //         ->onQueue('low')
        //         ->delay(Carbon::now()->addSeconds(10));
        // }
    }
}
