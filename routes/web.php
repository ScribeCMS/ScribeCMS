<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SessionController;
use App\Http\Controllers\CommentController;

Route::get( '/login', [ SessionController::class, 'create' ] )->name( 'login' )->middleware( 'guest' );
Route::put( '/login', [ SessionController::class, 'store' ] )->name( name: 'login.auth' );
Route::delete( '/logout', [ SessionController::class, 'destroy' ] )->name( name: 'logout' )->middleware( 'auth' );

Route::group(
    [
        'prefix' => '/admin',
        'middleware' => [ 'auth' ],
    ],
    function() {
        require 'admin/assets.php';
        require 'admin/dashboard.php';
        require 'admin/users.php';
        require 'admin/pages.php';
        require 'admin/posts.php';
        require 'admin/comments.php';
        //require 'admin/tags.php';
} );

Route::put( '/post/{post:slug}/comment', [ CommentController::class, 'storePublic' ] )->name( 'public.comments.store' );

require 'theme/assets.php';
require 'theme/templates.php';
