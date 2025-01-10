<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Post;
use App\Http\Actions\Post\CreatePost;
use App\Http\Actions\Post\UpdatePost;

class PostController
{
    public function index( Request $request )
    {
        $posts = Post::query()
            ->when( $request->has( 'trashed' ), function( $query ) {
                return $query->onlyTrashed();
            } )
            ->latest( 'published_at' )
            ->with('user')
            ->paginate(10);

        return view( Route::currentRouteName(), [ 'posts' => $posts ] );
    }

    public function create()
    {
        return view( Route::currentRouteName() );
    }

    public function show( Post $post )
    {
        return to_route( 'admin.posts.edit', [ 'post' => $post ] );
    }

    public function edit( Post $post )
    {
        return view( Route::currentRouteName(), [ 'post' => $post ] );
    }

    public function store( Post $post, CreatePost $create, Request $request )
    {
        $post = $create->handle( $post, $request );

        return to_route( 'admin.posts.edit', [ 'post' => $post ] );
    }

    public function update( Post $post, Request $request, UpdatePost $update )
    {
        $post = $update->handle( $post, $request );

        return to_route( 'admin.posts.edit', [ 'post' => $post ] );
    }

    public function trash( Post $post )
    {
        if ( $post->delete() ) {
            $post->update( [ 'slug' => null ] );
            return to_route( 'admin.posts.index' );
        }

        return back()->withErrors( [ 'message'=> 'Post could not be deleted' ] );
    }

    public function restore( Post $post )
    {
        if( $post->restore() ) {
            return to_route( 'admin.posts.index' );
        }

        return back()->withErrors( [ 'message'=> 'Post could not be restored' ] );
    }

    public function destroy( Post $post )
    {
        if ( $post->forceDelete() ) {
            return to_route( 'admin.posts.index', [ 'trashed' => 1 ] );
        }

        return back()->withErrors( [ 'message'=> 'Post could not be permanently deleted' ] );
    }
}

