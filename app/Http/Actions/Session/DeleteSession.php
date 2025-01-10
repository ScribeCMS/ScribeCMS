<?php
namespace App\Http\Actions\Session;

use Illuminate\Support\Facades\Auth;

class DeleteSession
{
    public function __invoke()
    {
        Auth::logout();
    }
}
