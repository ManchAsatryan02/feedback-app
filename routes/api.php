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

