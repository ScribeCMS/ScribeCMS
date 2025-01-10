<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AssetController;

Route::controller( AssetController::class )->group( function() {

    Route::get( '/assets/{file}', 'file' )
        ->where('file', '.*')
        ->name('assets');

} );
