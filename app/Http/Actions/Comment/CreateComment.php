<?php
namespace App\Http\Actions\Comment;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rule;

use App\Models\Post;
use App\Models\Comment;
use App\Enums\CommentStatus;

class CreateComment
{
    public function __invoke( Post $post, Request $request ): Comment
    {
        return $this->create( $post, $request );
    }

    public function create( Post $post, Request $request ): Comment
    {
        $request->merge( [
            'user_id' => $request->user()?->id,
            'post_id' => $post->id,
            'status' => $this->prepareStatus( $request?->status ),
            'ip' => $request->ip(),
            'ua' => $request->server('HTTP_USER_AGENT'),
            'name' => $this->prepareName( $request->name ),
            'body' => $this->prepareBody( $request->body ),
        ] );

        $validated = $request->validate( [
            'user_id' => 'nullable|exists:users,id',
            'post_id' => 'required|exists:posts,id',
            'parent_id' => 'nullable|exists:comments,id',
            'status' => [
                'required',
                Rule::enum( CommentStatus::class ),
            ],
            'ip' => 'nullable|ip',
            'ua' => 'nullable',
            'name' => 'required',
            'email' => 'required|email',
            'url' => 'nullable|url',
            'body' => 'required',
        ] );

        $comment = $post->comments()->create( $validated );

        return $comment;
    }

    protected function prepareStatus( string|null $status = 'published' )
    {
        // To do: more sophisiticaed status setting logic here.

        if ( ! CommentStatus::tryFrom( $status ) ) {
            $status = CommentStatus::PUBLISHED->value;
        }

        return $status;
    }

    protected function prepareName( string $name = '' )
    {
        return Str::of( $name )->stripTags();
    }

    protected function prepareBody( string $body = '' )
    {
        return Str::of( $body )->stripTags();
    }
}
