<?php

namespace App\Observers;

use App\Models\Image;

use Imagick;
use Storage;
use Exception;

class ImageThumbnailObserver
{
    /**
     * Handle the image "creating" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function creating(Image $image)
    {
        try {
            $thumbnail = new Imagick($image->path);
            $thumbnail->thumbnailImage(192, 0);
            $extenstion = '.' . \mb_strtolower($thumbnail->getImageFormat());
            $thumbnailPath = 'uploads/images/thumbnails/'.sha1($image->path).$extenstion;
            Storage::disk('local')->put($thumbnailPath, $thumbnail->getImagesBlob());

            $image->thumbnail = $thumbnailPath;
        } catch (Exception $ex) {
            session()->push('messages.danger', 'Error encountered during thumbnail process');
            return false;
        }
    }

    /**
     * Handle the image "deleting" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function deleting(Image $image)
    {
        if (!Storage::disk('local')->delete($image->thumbnail)) {
            session()->push('messages.danger', 'Failed to delete thumbnail image');
            return false;
        }
    }
}
