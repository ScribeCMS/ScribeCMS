<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CommentController;

Route::get( '/comments', [ CommentController::class, 'index' ] )
    ->name('admin.comments.index');

Route::get( '/comments/create', [ CommentController::class, 'create' ] )
    ->name('admin.comments.create');

Route::get( '/comments/{comment}', [ CommentController::class, 'show' ] )
    ->name('admin.comments.show');

Route::get( '/comments/{comment}/edit', [ CommentController::class, 'edit' ] )
    ->name('admin.comments.edit');

Route::put( '/comments', [ CommentController::class, 'store' ] )
    ->name('admin.comments.store');

Route::patch( '/comments/{comment}', [ CommentController::class, 'update' ] )
    ->name('admin.comments.update');

Route::delete( '/comments/{comment}/trash', [ CommentController::class, 'trash' ] )
    ->name('admin.comments.trash');

Route::post( '/comments/{comment}/restore', [ CommentController::class, 'restore' ] )
    ->withTrashed()
    ->name( 'admin.comments.restore' );

Route::delete( '/comments/{comment}/delete', [ CommentController::class, 'destroy' ] )
    ->withTrashed()
    ->name('admin.comments.destroy');
