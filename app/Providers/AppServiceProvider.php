<?php

namespace App\Providers;

use App\Observers\ImageObserver;
use App\Observers\ImageThumbnailObserver;
use App\Observers\ImageGoogleVisionObserver;
use App\Models\Image;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Image::observe(ImageObserver::class);
        Image::observe(ImageThumbnailObserver::class);
        Image::observe(ImageGoogleVisionObserver::class);
    }
}
