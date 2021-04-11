<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\UrlController;
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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('/', DashboardController::class)->only([
        'index'
    ]);
    Route::resource('url', UrlController::class);
});

Route::get('tag/{tag}', [UrlController::class, 'tag']);
Route::resource('shared/{shared}', ShareController::class);
