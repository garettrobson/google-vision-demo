<?php

namespace App\Observers;

use App\Models\Image;

use Storage;

class ImageObserver
{
    /**
     * Handle the image "deleting" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function deleting(Image $image)
    {
        if ($image->is_local && !Storage::delete($image->path)) {
            session()->push('messages.danger', 'Failed to delete local image');
            return false;
        }
    }
}
