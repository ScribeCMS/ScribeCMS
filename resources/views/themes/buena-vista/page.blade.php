<x-htmldoc>
    <div class="site-container">

    <x-theme::header />

    <h1><a href="{{ $page->url }}">{{ $page->title }}</a></h1>
    {!!
        $page->content(
            format: 'markdown',
        )
    !!}

    <x-theme::footer />

    </div>
    </x-htmldoc>
