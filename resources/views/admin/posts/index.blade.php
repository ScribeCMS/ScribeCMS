<x-admin::htmldoc doctitle="Posts">
<x-admin::sidebar />

<div class="main">

    <div class="header">
        <h1>{{ __('Posts') }}</h1>
        <div class="actions">
            <a href="{{ route('admin.posts.index') }}">{{ __('Published') }}</a> | <a href="{{ route( 'admin.posts.index', [ 'trashed' => 1 ] ) }}">{{ __('Trashed') }}</a>
            <a class="button primary" href="{{ route('admin.posts.create') }}">{{ __('Create New') }}</a>
        </div>
    </div>

    <div class="workspace">

        <div class="cards">
            @foreach( $posts as $post )
            <div class="card">
                <div class="info">
                    <h4><a target="_blank" href="{{ $post->url }}">{{ $post->title }}</a></h4>
                    <p class="p2 data">{{
                            __( 'By :author on :published', [
                                    'author' => $post->user->display_name,
                                    'published' => $post->published_at->format('F j, Y')
                                ]
                            )
                    }}</p>
                    @if( ! request('trashed') )
                    <p class="p2 status {{ $post->status }}">{{ Str::title( $post->status ) }}</p>
                    @endif
                </div>
                <div class="actions">
                    @if( request('trashed') )
                    <form method="post" action="{{ route( 'admin.posts.restore', $post ) }}">
                        @csrf
                        <button type="submit">{{ __('Restore') }}</button>
                    </form>
                    <form method="post" action="{{ route( 'admin.posts.destroy', $post ) }}">
                        @csrf
                        @method('delete')
                        <button class="danger" type="submit">{{ __('Delete Permanently') }}</button>
                    </form>
                    @else
                    <form method="post" action="{{ route( 'admin.posts.trash', $post ) }}">
                        @csrf
                        @method('delete')
                        <a href="{{ route( 'admin.posts.edit', [ 'post' => $post ] ) }}" class="button">{{ __('Edit') }}</a>
                        <button type="submit">{{ __('Trash') }}</button>
                    </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{ $posts->links() }}

    </div>

</div>

</x-admin::htmldoc>
