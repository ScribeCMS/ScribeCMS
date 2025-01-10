<?php
namespace App\Http\Actions\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rule;

use App\Models\User;
use App\Models\Post;
use App\Enums\PostStatus;

class UpdatePost
{
    protected $allowedTagsInTitle = [ '<b>', '<strong>', '<i>', '<em>', '<u>' ];
    protected $allowedStatuses = [ 'draft', 'published', 'scheduled', 'pending' ];

    public function handle( $post, $request ): Post
    {
        return $this->update( $post, $request );
    }

    public function update( Post $post, Request $request ): Post
    {
        $request->merge([
            'title' => $this->prepareTitle( $request->title ),
            'slug' => $this->prepareSlug( $request->slug, $request->title, $post ),
            'published_at' => $this->preparePublishedTimestamp( $request->date( 'published_at' ), config('app.timezone') ),
            'status' => $this->prepareStatus( $request->status ),
        ]);

        $validated = $request->validate([
            'title' => 'nullable',
            'slug' => [
                Rule::unique( 'posts' )->ignore( $post ),
            ],
            'body' => 'nullable',
            'published_at' => 'date', // To do: required_if:status,scheduled
            'status' => [
                'required',
                Rule::enum( PostStatus::class ),
            ],
            'user_id' => 'required|exists:users,id',
        ]);

        $post->update( $validated );

        return $post;
    }

    protected function prepareTitle( $title ): string|null
    {
        return Str::of( $title )->stripTags( $this->allowedTagsInTitle );
    }

    protected function prepareSlug( $slug, $title, Post $post ): string
    {
        $slug = Str::slug( $slug );
        $title = Str::of( $title )->stripTags();

        // Use the ID if $slug and $title are empty
        if ( empty( $slug ) && empty( $title ) ) {
            return Str::slug( 'post-' . $post->id );
        }

        $slug = $slug ?: Str::slug( $title );

        // if slug already exists, append the ID
        $slugExists = Post::where('slug', $slug )
                        ->whereNotIn('id' , [ $post->id ] )
                        ->exists();

        if ( $slugExists) {
            $slug = Str::slug( $slug . '-' . $post->id );
        }

        return $slug;
    }

    protected function prepareStatus( $status ): string
    {
        if ( ! PostStatus::tryFrom( $status ) ) {
            $status = PostStatus::DRAFT->value;
        }

        return $status;
    }

    protected function preparePublishedTimestamp( $timestamp, $tz ): string
    {
        return $timestamp ?
            Date::parse( $timestamp, $tz )
                ->setTimezone( 'UTC')
                ->format('Y-m-d H:i:s') :
            now();
    }
}
