<?php
namespace App\Http\Actions\Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class CreateSession
{
    public function __invoke( Request $request )
    {
        $creds = $request->validate( [
            'email' => 'required|email',
            'password' => 'required',
        ] );

        $auth = Auth::attempt( $creds, $request->remember );

        if ( $auth ) {
            $request->session()->regenerate();
        }

        return $auth;
    }
}
