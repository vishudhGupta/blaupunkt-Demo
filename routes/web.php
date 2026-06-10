<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('geoip.redirect')->get('/', function () {
    return view('welcome');
})->name('default-home');

Route::get('/switch-locale', [FrontendController::class, 'switchLocale'])->name('switch-locale');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');
Route::get('/sitemap-{locale}.xml', [SitemapController::class, 'locale'])->name('sitemap.locale');

Route::middleware(['auth', 'role:super-admin,editor,seo-manager,content-manager', 'audit'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    });

Route::prefix('{locale}')
    ->middleware('set.locale')
    ->group(function () {
        Route::get('/', [FrontendController::class, 'home'])->name('market.home');

        Route::get('/products', [FrontendController::class, 'products'])->name('market.products');
        Route::get('/products/{slug}', [FrontendController::class, 'productDetail'])->name('market.products.show');

        Route::get('/blogs', [FrontendController::class, 'blogs'])->name('market.blogs');
        Route::get('/blogs/{slug}', [FrontendController::class, 'blogDetail'])->name('market.blogs.show');

        Route::get('/category/{slug}', [FrontendController::class, 'category'])->name('market.category.show');
        Route::get('/search', [FrontendController::class, 'search'])
            ->middleware('throttle:web-search')
            ->name('market.search');

        Route::get('/{slug}', [FrontendController::class, 'page'])->name('market.page');
    });
