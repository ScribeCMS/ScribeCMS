<?php
use Illuminate\Support\Facades\Route;

Route::view( '/', 'admin.dashboard' )->name( 'admin.dashboard' );
