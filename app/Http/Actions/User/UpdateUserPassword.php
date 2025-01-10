<?php

namespace App\Http\Actions\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\User;
use App\Enums\UserRole;

class UpdateUserPassword
{
    public function __invoke( User $user, Request $request )
    {
        $validated = $request->validate(
            [
                'password' => 'required|confirmed'
            ]
        );

        $user->update( [
            'password' => $validated['password'],
        ] );

        return $user;
    }
}
