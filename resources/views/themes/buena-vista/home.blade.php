<x-htmldoc>
<div class="site-container">

<x-theme::header />

@if( $posts->isNotEmpty() )

    @foreach( $posts as $post )
        <h1><a href="{{ $post->url }}">{{ $post->title }}</a></h1>
        {!!
            $post->content(
                format: 'markdown',
                wordLimit: 100,
                moreText: __('Continue Reading')
            )
        !!}
    @endforeach

    {{ $posts->links() }}

@else
    {{ __('There are no posts') }}
@endif

<x-theme::footer />

</div>
</x-htmldoc>
