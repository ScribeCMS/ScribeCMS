<?php

namespace App\Http\Actions\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\User;
use App\Enums\UserRole;

class CreateUser
{
    public function __invoke( User $user, Request $request )
    {
        $userdata = $request->validate(
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'display_name' => '',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'website' => 'nullable',
                'role' => [
                    'required',
                    Rule::enum( UserRole::class ),
                ],
            ]
        );

        $user->create( $userdata );
    }
}
