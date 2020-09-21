<?php

namespace App\Observers;

use App\Models\Image;
use App\Models\Label;

use Storage;
use Exception;
use Error;

use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class ImageGoogleVisionObserver
{
    /**
     * Handle the image "created" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function created(Image $image)
    {
        try {
            // Get image data
            $data = $image->is_local === 1 ?
                Storage::disk('local')->get($image->path):
                $image->path;

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
        } catch(Exception $ex) {
            session()->push('messages.danger', 'Error occurred during google vision operation');
        } catch(Error $ex) {
            session()->push('messages.danger', 'Error occurred during google vision operation');
        }
    }
}
