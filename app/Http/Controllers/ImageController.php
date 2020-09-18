<?php

namespace App\Http\Controllers;

use App\Models\Image;

use Illuminate\Http\Request;

use Imagick;
use Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::orderBy('created_at', 'desc')->paginate(10);

        return view('images.index', [
            'images' => $images,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image-upload' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);

        // Save uploaded image & get file name
        $image = $request->file('image-upload');
        $path = $image->store('uploads/images/files');
        $fname = basename($path);

        // Save thumbnail using same file name
        $thumbnail = new Imagick($image->path());
        $thumbnail->thumbnailImage(128, 0);
        $thumbnailPath = 'uploads/images/thumbnails/'.$fname;
        Storage::disk('local')->put($thumbnailPath, $thumbnail->getImagesBlob());

        // Create the image
        Image::create([
            'path' => $path,
            'file_name' => $image->getClientOriginalName(),
            'mime_type' => \mime_content_type($image->path()),
            'thumbnail' => $thumbnailPath,
        ]);

        // Success redirect with message
        return redirect()->route('images.index')->with('status', 'Image uploaded successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
