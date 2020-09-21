# Google Vision Demo

Author: Garett Robson

## Requirements

**Modules**

* PHP ImageMagik Module

**Important**

 This demo authenticates with Google using a Service Account JSON file which is loaded via the environment variable `GOOGLE_APPLICATION_CREDENTIALS`, details available [here](https://cloud.google.com/docs/authentication/production).

## Installation

To install the demo you will need to;

1. Clone the repo
2. Run `composer install`
3. Copy the `.env.example` file to `.env`
4. Setup a MySQL database and update the `.env` file with the credentials
5. Run `php artisan migrate`
6. Setup the `GOOGLE_APPLICATION_CREDENTIALS` environment variable pointing at a valid Service Account JSON file
7. Ensure the upload symlink points to the storage upload data (`public/uploads -> ../storage/app/uploads`)
8. (Optional) Ensure web server will follow symlinks for thumbnails to work

Images that are uploaded and thumbnails generated are stored in the directory `./storage/app/uploads`. The symlink `./public/uploads` should point at the upload directory for the thumbnails to display correctly and for click-through to the uploaded image. To disable the thumbnail functionality, and by-pass the need for ImageMagik, the `ImageThumbnailObserver` may be detached from the `Image` model in `./app/Providers/AppServiceProvider.php`.
