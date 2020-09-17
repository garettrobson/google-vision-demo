<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('images', App\Http\Controllers\ImageController::class)->only([
    'index', 'create', 'store', 'destroy'
]);

Route::redirect('/', route('images.index'));
