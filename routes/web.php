<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\HomeController;
use App\Http\Controllers\Api\Admin\BlogController;
use App\Http\Controllers\Api\Admin\AboutController;
use App\Http\Controllers\Api\Admin\GalleryController;
use App\Http\Controllers\Api\Admin\ApplicationController;
use App\Http\Controllers\Api\Admin\ContactController;
use App\Http\Controllers\Api\Admin\FeedbackController;
use App\Http\Controllers\Api\Admin\SliderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Admin
Route::group(['prefix'=>'admin'], function(){
    // Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Blog actions
    Route::controller(BlogController::class)->group(function () {
        Route::get('/blog', 'index')->name('blog-index');
        Route::get('/blog/show/{id}', 'show')->name('blog-show');
        Route::post('/blog/store', 'store')->name('blog-store');
        Route::post('/blog/update/{id}', 'update')->name('blog-update');
        Route::get('/blog/destroy/{id}', 'destroy')->name('blog-destroy');
    });

    // Application actions
    Route::controller(ApplicationController::class)->group(function () {
        Route::get('/application', 'index')->name('application-index');
        Route::get('/application/show/{id}', 'show')->name('application-show');
        Route::post('/application/store', 'store')->name('application-store');
        Route::post('/application/update/{id}', 'update')->name('application-update');
        Route::get('/application/destroy/{id}', 'destroy')->name('application-destroy');
    });

    // Slider actions
    Route::controller(SliderController::class)->group(function () {
        Route::get('/slider', 'index')->name('slider-index');
        Route::post('/slider/update', 'update')->name('slider-update');
    });

    // Feedback actions
    Route::controller(FeedbackController::class)->group(function () {
        Route::get('/feedback', 'index')->name('feedback-index');
        Route::get('/feedback/show/{id}', 'show')->name('feedback-show');
        Route::post('/feedback/update/{id}', 'update')->name('feedback-update');
        Route::get('/feedback/destroy/{id}', 'destroy')->name('feedback-destroy');
    });

    // Gallery actions
    Route::controller(GalleryController::class)->group(function () {
        Route::get('/gallery', 'index')->name('gallery-index');
        Route::get('/gallery/show/{id}', 'show')->name('gallery-show');
        Route::post('/gallery/store', 'store')->name('gallery-store');
        Route::post('/gallery/update/{id}', 'update')->name('gallery-update');
        Route::get('/gallery/destroy/{id}', 'destroy')->name('gallery-destroy');
    });

    // Contact actions
    Route::controller(ContactController::class)->group(function () {
        Route::get('/contact', 'index')->name('contact-index');
        Route::get('/contact/destroy/{id}', 'destroy')->name('contact-destroy');
    });

    // About actions
    Route::controller(AboutController::class)->group(function () {
        Route::get('/about', 'index')->name('about-index');
        Route::post('/about/update', 'update')->name('about-update');
    });
    
});