<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

use App\Models\Comment;
use App\Models\Post;
use App\Http\Actions\Comment\CreateComment;
use App\Http\Actions\Comment\UpdateComment;

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
            ->latest()
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

    public function storePublic( Post $post, Request $request, CreateComment $createComment )
    {
        if ( $comment = $createComment( $post, $request ) ) {
            return back()
                ->withFragment( 'comment-' . $comment->id )
                ->with( 'success', __('Comment Created') );
        }

        return back()->withErrors( [ 'message'=> 'Comment could not be created.' ] );
    }

    public function update( Comment $comment, Request $request, UpdateComment $updateComment )
    {
        $comment = $updateComment( $comment, $request );

        return to_route( 'admin.comments.edit', [ 'comment' => $comment ] );
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
