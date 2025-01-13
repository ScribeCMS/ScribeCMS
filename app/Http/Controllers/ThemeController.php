<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Database\Eloquent\Builder;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;


class ThemeController extends Controller
{
    public function home()
    {
        $posts = Post::query()
            ->latest( 'published_at' )
            ->published()
            ->with('user')
            ->paginate(10);

        return view()->first(
            [
                'theme::home',
                'theme::index',
            ],
            [ 'posts' => $posts ] );
    }

    public function singular( string $slug, Page $page, Post $post )
    {
        if ( $page = $page->published()->slug( $slug )->with( 'user' )->first() ) {
            return view()->first(
                [
                    'theme::page-' . $page->slug,
                    'theme::page-' . $page->id,
                    'theme::page',
                    'theme::singular',
                ],
                [ 'page' => $page ]
            );
        }

        // Eager load Comments and User with Post
        $post = $post->query()
                ->published()
                ->slug( $slug )
                ->with( [
                    'comments' => function( Builder $query ) {
                        $query->whereNull( 'parent_id' );
                    },
                    'user',
                ] )
                ->first();

        if ( $post ) {
            return view()->first(
                [
                    'theme::post-' . $post->slug,
                    'theme::post-' . $post->id,
                    'theme::post',
                    'theme::singular',
                ],
                [ 'post' => $post ]
            );
        }

        return $this->notFound();
    }

    public function pageByID( Page $page )
    {
        return to_route( 'singular', [ 'slug' => $page->slug ], 301 );
    }

    public function postById( Post $post )
    {
        return to_route( 'singular', [ 'slug' => $post->slug ], 301 );
    }

    public function posts()
    {
        $posts = Post::query()
            ->latest()
            ->published()
            ->with( 'user' )
            ->paginate( 10 );

        return view()->first(
            [
                'theme::posts',
                'theme::archive-post',
            ],
            [ 'posts' => $posts ]
        );
    }

    public function tag( Tag $tag )
    {
        return view()->first(
            [
                'theme::tag-' . $tag->slug,
                'theme::tag-' . $tag->id,
                'theme::tag',
                'theme::archive-tag',
                'theme::archive',
            ],
            [ 'tag' => $tag ]
        );
    }

    public function author( User $user )
    {
        return view()->first(
            [
                'theme::author-' . $user->id,
                'theme::author',
                'theme::archive',
            ],
            [ 'user' => $user ]
        );
    }

    public function search( string $search )
    {
        return view( 'theme::search', [ 'search' => $search ] );
    }

    public function notFound()
    {
        return response()->view( 'theme::404', [], 404 );
    }
}
