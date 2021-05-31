<?php

namespace App\Listeners;

use UniSharp\LaravelFilemanager\Events\ImageWasUploaded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Intervention\Image\Facades\Image;


class UploadListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $method = 'on' . class_basename($event);
        if (method_exists($this, $method)) {
            call_user_func([$this, $method], $event);
        }
    }

    public function onImageWasUploaded(ImageWasUploaded $event)
    {
        $path = $event->path();
        // chỉnh ảnh về kích thước 400*250
        $image = Image::make($path);
        if ($image->width() !== 400 || $image->height() !== 250) {
            $image->fit(400, 250, function ($constraints) {
                $constraints->aspectRatio();
                $constraints->upsize();
            })->save();
        }
        return;
    }
}
