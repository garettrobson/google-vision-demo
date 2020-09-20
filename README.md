# Google Vision Demo

Author: Garett Robson

## Requirements

**Modules**

* PHP ImageMagik Module

**Important**

 This demo authenticates with Google using a Service Account JSON file which is loaded via the environment variable `GOOGLE_APPLICATION_CREDENTIALS`, details available [here](https://cloud.google.com/docs/authentication/production).

## Installation

To install the demo you will need to;

1. Close the repo
1. Copy the `.env.example` file to `.env`
1. Setup a MySQL database and update the `.env` file with the credentials
1. Run the migrations
1. Setup the `GOOGLE_APPLICATION_CREDENTIALS` environment variable pointing at a valid Service Account JSON file
1. Ensure the upload directory is setup <sup>*1</sup>
1. (Optional) Ensure web server will follow symlinks for thumbnails to work

<sup>*1</sup> Uploaded files are stored in the `./storage/app/uploads`, this is also the location that thumbnail files are stored in. When an image is uploaded or referenced with a URL a thumbnail will be simultaneously generated. This feature required the PHP ImageMagik module be installed. The symlink `./public/uploads` should point at this upload directory for thumbnails to display correctly.
