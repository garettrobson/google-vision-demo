<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Label;

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
    public function index(Label $filter = null)
    {

        $images = $filter ?
            $filter->images()->orderBy('created_at', 'desc'):
            Image::orderBy('created_at', 'desc');

        return view('images.index', [
            'images' => $images->paginate(10),
            'filter' => $filter,
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
            'thumbnail' => '\\'.$thumbnailPath,
        ]);

        // Success redirect with message
        return redirect()->route('images.index')->with('status', 'Image uploaded successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $image->delete();
        return redirect()->route('images.index')->with('status', 'Image deleted successfully');
    }

    /**
     * Show the form for creating a new resource from a url.
     *
     * @return \Illuminate\Http\Response
     */
    public function createWeb()
    {
        return view('images.web');
    }

    /**
     * Store a newly created web resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRemote(Request $request)
    {
        $data = $request->validate([
            'url' => 'required|url',
        ]);

        // Use the url as a path
        $path = $data['url'];
        $url = parse_url($path);
        $fname = isset($url['path']) ?
            basename($url['path']) :
            '[Unknown]';

        // Save thumbnail using same file name
        $thumbnail = new Imagick($path);
        $thumbnail->thumbnailImage(128, 0);
        $extenstion = '.' . \mb_strtolower($thumbnail->getImageFormat());
        $thumbnailPath = 'uploads/images/thumbnails/'.sha1($path).$extenstion;
        Storage::disk('local')->put($thumbnailPath, $thumbnail->getImagesBlob());

        // Create the image
        Image::create([
            'path' => $path,
            'file_name' => $fname,
            'mime_type' => $thumbnail->getImageMimeType(),
            'thumbnail' => '\\'.$thumbnailPath,
            'is_local' => 0,
        ]);

        // Success redirect with message
        return redirect()->route('images.index')->with('status', 'Remote image stored successfully');

    }
}
