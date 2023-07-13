<?php

use App\Http\Controllers\Auth\PaintingController;
use App\Http\Controllers\Auth\PaintingImagesController;
use App\Http\Controllers\Auth\ShowController;
use App\Http\Controllers\LoginController;
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
Route::get('/test', [\App\Http\Controllers\TestController::class, 'test']);

Route::get('/admin/login', [ShowController::class, 'showLoginArminForm']);
Route::get('/admin/login/log', [LoginController::class, 'login']);

Route::prefix('api')
    ->group(function() {
        Route::get('/get-painting-by-id', [PaintingController::class, 'getPaintingById']);
        Route::post('/update-painting', [PaintingController::class, 'updatePainting']);
        Route::get('/get-last-painting', [PaintingController::class, 'getLastPainting']);
        Route::get('/get-all-painting-with-pagination', [PaintingController::class, 'getAllPaintingsWithPagination']);
        Route::post('/create-painting', [PaintingController::class, 'storePainting']);
        Route::post('/delete-painting-image', [PaintingImagesController::class, 'deleteImage']);
    });


Route::prefix('admin')->middleware('administration')
    ->group(function() {
        Route::get('/', [ShowController::class, 'showAdmin']);
        Route::get("{any?}",\App\Http\Controllers\BackendController::class)->where('any', '.*');
    });

Route::group([], function() {
    Route::get('/', [ShowController::class, 'showApp']);
    Route::get("{any?}",\App\Http\Controllers\FrontendController::class)->where('any', '.*');
});

