<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Actions\Session\CreateSession;
use App\Http\Actions\Session\DeleteSession;
use Illuminate\Validation\ValidationException;

class SessionController
{
    public function create()
    {
        return view( 'login' );
    }

    public function store( CreateSession $createSession, Request $request )
    {
        if ( ! $createSession( $request ) ) {
            throw ValidationException::withMessages(
                [ 'email' => __( 'Invalid credentials' ) ]
            );
        }

        return redirect()->intended( route( 'admin.dashboard' ) );
    }

    public function destroy( DeleteSession $deleteSession, Request $request )
    {
        $deleteSession( $request );
        return back();
    }
}
