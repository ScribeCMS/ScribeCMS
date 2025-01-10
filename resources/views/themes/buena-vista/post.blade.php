<x-htmldoc>
    <div class="site-container">

    <x-theme::header />

    <article class="entry">
        <h1><a href="{{ $post->url }}">{{ $post->title }}</a></h1>
        {!!
            $post->content(
                format: 'markdown',
            )
        !!}

    @if( $post->comments->isNotEmpty() )
    <div id="comments">
        <h3>{{ __( 'Comments' ) }}</h3>
        <ul class="comment-list">
            @foreach( $post->comments as $comment )
                <li id="{{ $comment->id }}">
                    <p>{{ __( 'By :name on :date', [ 'name' => $comment->name, 'date' => $comment->created_at ] ) }}</p>
                    <p>{{ $comment->body }}
                </li>
            @endforeach
        </ul>
    </div>
    @endif

    <x-theme::footer />

    </div>
    </x-htmldoc>
