<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

use App\Models\Comment;

class CommentController
{
    public function index( Request $request )
    {
        $comments = Comment::query()
            ->when( $request->has( 'status' ), function( $query ) use( $request ) {
                if ( $request->status === 'trashed' ) {
                    return $query->onlyTrashed();
                }

                if ( in_array( $request->status, [ 'published', 'pending', 'spam' ] ) ) {
                    return $query->where( 'status', $request->status );
                }
            } )
            ->orderBy('published_at', 'desc')
            ->with( 'post' )
            ->with( 'parent' )
            ->with( 'replies' )
            ->with( 'user' )
            ->simplePaginate(10);

        return view( Route::currentRouteName(), [ 'comments' => $comments ] );
    }

    public function create()
    {
        return view(Route::currentRouteName());
    }

    public function show( Route $route )
    {
        //redirect()->action([ get_called_class(), 'edit' ]);
    }

    public function edit( Comment $comment )
    {
        return view(Route::currentRouteName());
    }

    public function store()
    {

    }

    public function update()
    {

    }

    public function trash( Comment $comment )
    {
        if ( $comment->delete() ) {
            return to_route( 'admin.comments.index' );
        }

        return back()->withErrors( [ 'message'=> 'Comment could not be deleted' ] );
    }

    public function restore( Comment $comment )
    {
        if ( $comment->restore() ) {
            return to_route( 'admin.comments.index' );
        }

        return back()->withErrors( [ 'message'=> 'Comment could not be restored' ] );
    }

    public function destroy( Comment $comment )
    {
        if ( $comment->forceDelete() ) {
            return to_route( 'admin.comments.index', [ 'status' => 'trashed' ] );
        }

        return back()->withErrors( [ 'message'=> 'Comment could not be permanently deleted' ] );
    }
}
