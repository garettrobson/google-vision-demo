<?php

namespace App\Observers;

use App\Models\Image;

use Imagick;
use Storage;

class ThumbnailImageObserver
{
    /**
     * Handle the image "creating" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function creating(Image $image)
    {

        $thumbnail = new Imagick($image->path);
        $thumbnail->thumbnailImage(128, 0);
        $extenstion = '.' . \mb_strtolower($thumbnail->getImageFormat());
        $thumbnailPath = 'uploads/images/thumbnails/'.sha1($image->path).$extenstion;
        Storage::disk('local')->put($thumbnailPath, $thumbnail->getImagesBlob());

        $image->thumbnail = $thumbnailPath;

    }
}
