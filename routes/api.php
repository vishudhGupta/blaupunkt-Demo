<?php

use App\Http\Controllers\Api\ContentApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('{locale}')
    ->middleware('set.locale')
    ->group(function () {
        Route::get('/products', [ContentApiController::class, 'products']);
        Route::get('/blogs', [ContentApiController::class, 'blogs']);
        Route::get('/pages/{slug}', [ContentApiController::class, 'page']);
    });
