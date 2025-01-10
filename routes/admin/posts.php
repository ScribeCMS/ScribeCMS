<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;

Route::get( '/posts', [ PostController::class, 'index' ] )
    ->name('admin.posts.index');

Route::get( '/posts/create', [ PostController::class, 'create' ] )
    ->name('admin.posts.create');

Route::get( '/posts/{post}', [ PostController::class, 'show' ] )
    ->name('admin.posts.show');

Route::get( '/posts/{post}/edit', [ PostController::class, 'edit' ] )
    ->name('admin.posts.edit');

Route::put( '/posts', [ PostController::class, 'store' ] )
    ->name('admin.posts.store');

Route::patch( '/posts/{post}', [ PostController::class, 'update' ] )
    ->name('admin.posts.update');

Route::delete( '/posts/{post}/trash', [ PostController::class, 'trash' ] )
    ->name('admin.posts.trash');

Route::post( '/posts/{post}/restore', [ PostController::class, 'restore' ] )
    ->withTrashed()
    ->name( 'admin.posts.restore' );

Route::delete( '/posts/{post}/delete', [ PostController::class, 'destroy' ] )
    ->withTrashed()
    ->name('admin.posts.destroy');
