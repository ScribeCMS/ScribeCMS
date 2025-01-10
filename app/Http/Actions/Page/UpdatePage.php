<?php
namespace App\Http\Actions\Page;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rule;

use App\Models\User;
use App\Models\Page;
use App\Enums\PageStatus;

class UpdatePage
{
    protected $allowedTagsInTitle = [ '<b>', '<strong>', '<i>', '<em>', '<u>' ];

    public function handle( $page, $request ): Page
    {
        return $this->update( $page, $request );
    }

    public function update( Page $page, Request $request ): Page
    {
        $request->merge([
            'title' => $this->prepareTitle( request('title') ),
            'slug' => $this->prepareSlug( request('slug'), request('title'), $page ),
            'published_at' => $this->preparePublishedTimestamp( request('published_at'), config('app.timezone') ),
            'status' => $this->prepareStatus( request('status') ),
        ]);

        $validated = $request->validate([
            'title' => 'nullable',
            'slug' => [
                Rule::unique( 'pages', 'slug' )->ignore($page->id ),
            ],
            'body' => 'nullable',
            'published_at' => 'date', // To do: required_if:status,scheduled
            'status' => [
                'required',
                Rule::enum( PageStatus::class ),
            ],
            'user_id' => 'required|exists:users,id',
        ]);

        $page->update( $validated );

        return $page;
    }

    protected function prepareTitle( $title ): string|null
    {
        return Str::of( Str::trim( $title ) )->stripTags( $this->allowedTagsInTitle );
    }

    protected function prepareSlug( $slug, $title, Page $page ): string
    {
        $slug = Str::trim( $slug );
        $title = (string) Str::of( $title )->trim()->stripTags();

        // Use the ID if $slug and $title are empty
        if ( empty( $slug ) && empty( $title ) ) {
            return Str::slug( 'page-' . $page->id );
        }

        $slug = $slug ? Str::slug( $slug ) : Str::slug( $title );

        // if slug already exists, append the ID
        $slugExists = Page::where('slug', $slug )
                        ->whereNotIn('id' , [ $page->id ] )
                        ->exists();

        if ( $slugExists) {
            $slug = $slug . '-' . $page->id;
        }

        return $slug;
    }

    protected function preparePublishedTimestamp( $timestamp, $tz ): string
    {
        return $timestamp ?
            Date::parse( $timestamp, $tz )
                ->setTimezone( 'UTC')
                ->format('Y-m-d H:i:s') :
            now();
    }

    protected function prepareStatus( $status ): string
    {
        if ( ! PageStatus::tryFrom( $status ) ) {
            $status = PageStatus::DRAFT->value;
        }

        return $status;
    }
}
