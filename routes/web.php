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

Route::get('/administration/login/log', [LoginController::class, 'login']);
Route::get('/admin/login', [ShowController::class, 'showLoginArminForm']);

Route::get('/get-last-painting', [PaintingController::class, 'getLastPainting']);
Route::get('/get-all-painting-with-pagination', [PaintingController::class, 'getAllPaintingsWithPagination']);

Route::get('/', [ShowController::class, 'showApp']);



Route::prefix('admin')->middleware('administration')
    ->group(function() {
        Route::get('/', [ShowController::class, 'showAdmin']);
        Route::post('/create-painting', [PaintingController::class, 'storePainting']);
    });

Route::group([], function() {
    Route::get('/', [ShowController::class, 'showApp']);

});

Route::fallback(\App\Http\Controllers\FrontendController::class);
