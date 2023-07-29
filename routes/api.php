<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\SliderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('api/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResource('/api/user', AuthController::class);
    
    Route::get('/application', [ApplicationController::class, 'index']);
    Route::get('/application/{id}', [ApplicationController::class, 'show']);

    
});

// Admin
Route::group(['prefix'=>'admin'], function(){
    // Blog actions
    Route::controller(App\Http\Controllers\Api\Admin\BlogController::class)->group(function () {
        Route::get('/blog', 'index');
        Route::get('/blog/show/{id}', 'show');
        Route::post('/blog/store', 'store');
        Route::post('/blog/update/{id}', 'update');
        Route::get('/blog/destroy/{id}', 'destroy');
    });

    // Application actions
    Route::controller(App\Http\Controllers\Api\Admin\ApplicationController::class)->group(function () {
        Route::get('/application', 'index');
        Route::get('/application/show/{id}', 'show');
        Route::post('/application/store', 'store');
        Route::post('/application/update/{id}', 'update');
        Route::get('/application/destroy/{id}', 'destroy');
    });

    // Slider actions
    Route::controller(App\Http\Controllers\Api\Admin\SliderController::class)->group(function () {
        Route::get('/slider', 'index');
        Route::post('/slider/update', 'update');
    });

    // Feedback actions
    Route::controller(App\Http\Controllers\Api\Admin\FeedbackController::class)->group(function () {
        Route::get('/feedback', 'index');
        Route::get('/feedback/show/{id}', 'show');
        Route::post('/feedback/store', 'store');
        Route::post('/feedback/update/{id}', 'update');
        Route::get('/feedback/destroy/{id}', 'destroy');
    });

    // Gallery actions
    Route::controller(App\Http\Controllers\Api\Admin\GalleryController::class)->group(function () {
        Route::get('/gallery', 'index');
        Route::get('/gallery/show/{id}', 'show');
        Route::post('/gallery/store', 'store');
        Route::post('/gallery/update/{id}', 'update');
        Route::get('/gallery/destroy/{id}', 'destroy');
    });

    // Contact actions
    Route::controller(App\Http\Controllers\Api\Admin\ContactController::class)->group(function () {
        Route::get('/contact', 'index');
        Route::get('/contact/show/{id}', 'show');
        Route::get('/contact/destroy/{id}', 'destroy');
    });

    // About actions
    Route::controller(App\Http\Controllers\Api\Admin\AboutController::class)->group(function () {
        Route::get('/about', 'index');
        Route::post('/about/update', 'update');
    });
    
});

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{id}', [BlogController::class, 'show']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/gallery', [GalleryController::class, 'index']);
Route::get('/feedback', [FeedbackController::class, 'index']);
Route::post('/contact-message', [ContactController::class, 'send_message']);
Route::post('/feedback-message', [FeedbackController::class, 'send_feedback']);

