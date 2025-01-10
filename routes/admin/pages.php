<?php
use App\Http\Controllers\PageController;

Route::get( '/pages', [ PageController::class, 'index' ] )
    ->name('admin.pages.index');

Route::get( '/pages/create', [ PageController::class, 'create' ] )
    ->name('admin.pages.create');

Route::get( '/pages/{page}', [ PageController::class, 'show' ] )
    ->name('admin.pages.show');

Route::get( '/pages/{page}/edit', [ PageController::class, 'edit' ] )
    ->name('admin.pages.edit');

Route::put( '/pages', [ PageController::class, 'store' ] )
    ->name('admin.pages.store');

Route::patch( '/pages/{page}', [ PageController::class, 'update' ] )
    ->name('admin.pages.update');

Route::delete( '/pages/{page}/trash', [ PageController::class, 'trash' ] )
    ->name('admin.pages.trash');

Route::post( '/pages/{page}/restore', [ PageController::class, 'restore' ] )
    ->withTrashed()
    ->name( 'admin.pages.restore' );

Route::delete( '/pages/{page}/delete', [ PageController::class, 'destroy' ] )
    ->withTrashed()
    ->name('admin.pages.destroy');
