<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

use App\Http\Controllers\ThemeController;

Route::controller(ThemeController::class)->group(function () {

    Route::fallback('notFound');

    Route::get('/search/?q={search}', 'search')->name('search');

    //Route::get( '/tag/{tag:slug}', 'tag' )->name('archive.tag');
    Route::get('/posts', 'posts')->name('archive.post');

    // These all redirect to `/{slug}` by default
    Route::get('/page/{page:id}', 'pageById');
    Route::get('/post/{post:id}', 'postById');
    Route::get('/p/{post:id}', 'postById');

    // Single Page or Post
    Route::get('/{slug}', 'singular')->name('singular');

    // Homepage
    Route::get('/', 'home')->name('home');

});
