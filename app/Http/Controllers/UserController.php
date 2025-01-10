<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Http\Actions\User\CreateUser;
use App\Http\Actions\User\UpdateUser;
use App\Http\Actions\User\UpdateUserPassword;

class UserController
{
    public function index( Request $request )
    {
        $users = User::query()
            ->orderBy('email', 'asc')
            ->simplePaginate(10);

        return view( Route::currentRouteName(), [ 'users' => $users ] );
    }

    public function create()
    {
        return view(Route::currentRouteName() );
    }

    public function show( User $user )
    {
        return to_route( 'admin.users.edit', [ 'user' => $user ] );
    }

    public function edit( User $user )
    {
        return view(Route::currentRouteName(), [ 'user' => $user ] );
    }

    public function editPassword( User $user )
    {
        return view(Route::currentRouteName(), [ 'user' => $user ] );
    }

    public function store( User $user, CreateUser $createUser, Request $request )
    {
        if ( $createUser( $user, $request ) ) {
            return to_route( 'admin.users.index' )
                ->with( 'success', __('User created') );
        }

        return back()->withErrors( [ 'message' => 'User could not be created' ] );
    }

    public function update( User $user, Request $request, UpdateUser $updateUser )
    {
        if ( $user = $updateUser( $user, $request ) ) {
            return to_route( 'admin.users.edit', [ 'user' => $user ] )
                ->with( 'success', __('User updated successfully') );
        }

        return back()->withErrors( [ 'message' => 'User could not be updated' ] );
    }

    public function updatePassword( User $user, Request $request, UpdateUserPassword $updateUserPassword )
    {
        if ( $user = $updateUserPassword( $user, $request ) ) {
            return to_route( 'admin.users.edit', [ 'user' => $user ] )
                ->with( 'success', __('Password updated') );
        }

        return back()->withErrors( [ 'message' => 'Password could not be updated' ] );
    }

    public function destroy( User $user )
    {
        if ( $user->delete() ) {
            return to_route( 'admin.users.index' )
                ->with('success', __('User deleted'));
        }

        return back()->withErrors( [ 'message' => 'User could not be deleted' ] );
    }
}
