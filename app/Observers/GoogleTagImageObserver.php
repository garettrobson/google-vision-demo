<?php

namespace App\Observers;

use App\Models\Image;
use App\Models\Label;

use Storage;

use Google\Cloud\Vision\V1\ImageAnnotatorClient;


class GoogleTagImageObserver
{
    /**
     * Handle the image "created" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function created(Image $image)
    {
        // Get image data
        $data = Storage::disk('local')->get($image->path);

        // Request labels for image
        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->labelDetection($data);
        $labels = $response->getLabelAnnotations();

        if (!$labels) {
            return;
        }

        foreach ($labels as $label) {
            $image->labels()->attach(
                Label::fromName($label->getDescription())->id
            );
        }
    }

}
