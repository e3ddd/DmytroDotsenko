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


Route::get('/', [ShowController::class, 'showIndex']);
Route::get('/administration/login', [ShowController::class, 'showLoginArminForm']);
Route::get('/administration/login/log', [LoginController::class, 'login']);

Route::get('/get-last-painting', [PaintingController::class, 'getLastPainting']);
Route::get('/get-all-painting-with-pagination', [PaintingController::class, 'getAllPaintingsWithPagination']);

Route::middleware('administration')
    ->group(function() {
        Route::get('/administration', [ShowController::class, 'showAdminPanel']);
        Route::get('/administration/catalog', [ShowController::class, 'showTest']);
        Route::post('/administration/create-painting', [PaintingController::class, 'storePainting']);
});

