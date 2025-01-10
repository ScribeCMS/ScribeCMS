<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

Route::get( '/users', [ UserController::class, 'index' ] )
    ->name('admin.users.index');

Route::get( '/users/create', [ UserController::class, 'create' ] )
    ->name('admin.users.create');

Route::get( '/users/{user}', [ UserController::class, 'show' ] )
    ->name('admin.users.show');

Route::get( '/users/{user}/edit', [ UserController::class, 'edit' ] )
    ->name('admin.users.edit');

Route::get( '/users/{user}/password/edit', [ UserController::class, 'editPassword' ] )
    ->name('admin.users.editpassword');

Route::put( '/users', [ UserController::class, 'store' ] )
    ->name('admin.users.store');

Route::patch( '/users/{user}/password', [ UserController::class, 'updatePassword' ] )
    ->name('admin.users.updatepassword');

Route::patch( '/users/{user}', [ UserController::class, 'update' ] )
    ->name('admin.users.update');

Route::delete( '/users/{user}', [ UserController::class, 'destroy' ] )
    ->name('admin.users.destroy');
