<?php

namespace App\Providers;

use App\Observers\ThumbnailImageObserver;
use App\Observers\GoogleTagImageObserver;
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
        Image::observe(ThumbnailImageObserver::class);
        Image::observe(GoogleTagImageObserver::class);
    }
}
