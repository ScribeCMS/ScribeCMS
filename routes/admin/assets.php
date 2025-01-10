<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminAssetController;

Route::controller( AdminAssetController::class )->group( function() {

    Route::get( '/assets/{file}', 'file' )
        ->where('file', '.*')
        ->name('admin.assets')
        ->withoutMiddleware('auth');

} );
