<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        return view(Route::currentRouteName());
    }

    public function create()
    {
        return view(Route::currentRouteName());
    }

    public function show( Route $route )
    {
        //redirect()->action([ get_called_class(), 'edit' ]);
    }

    public function edit( Tag $tag )
    {
        return view(Route::currentRouteName());
    }

    public function store()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
