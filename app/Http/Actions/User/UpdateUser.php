<?php

namespace App\Http\Actions\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\User;
use App\Enums\UserRole;

class UpdateUser
{
    public function __invoke( User $user, Request $request )
    {
        $validated = $request->validate(
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'display_name' => 'nullable',
                'email' => [
                    'required',
                    'email',
                    Rule::unique( 'users' )->ignore( $user ),
                ],
                'role' => [
                    'required',
                    Rule::enum( UserRole::class ),
                ],
                'avatar' => 'nullable',
                'cover' => 'nullable',
                'website' => 'nullable|url',
                'bio' => 'nullable',
                'archive_title' => 'nullable',
                'archive_bio' => 'nullable',
                'archive_doctitle' => 'nullable',
                'archive_metadesc' => 'nullable',
            ]
        );

        $user->update( $validated );

        return $user;
    }
}
