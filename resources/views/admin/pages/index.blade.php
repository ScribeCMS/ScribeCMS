<x-admin::htmldoc :doctitle="__('Pages')">
<x-admin::sidebar />

<div class="main">

    <div class="header">
        <h1>{{ __('Pages') }}</h1>
        <div class="actions">
            <a href="{{ route('admin.pages.index') }}">{{ __('Published') }}</a> | <a href="{{ route( 'admin.pages.index', [ 'trashed' => 1 ] ) }}">{{ __('Trashed') }}</a>
            <a class="button primary" href="{{ route('admin.pages.create') }}">{{ __('Create New') }}</a>
        </div>
    </div>

    <div class="workspace">

        <div class="cards">
            @foreach( $pages as $page )
            <div class="card">
                <div class="info">
                    <h4><a target="_blank" href="{{ $page->url }}">{{ $page->title }}</a></h4>
                    <p class="p2 data">{{
                            __( 'By :author on :published', [
                                    'author' => $page->user->display_name,
                                    'published' => $page->published_at->format('F j, Y')
                                ]
                            )
                    }}</p>
                    @if( ! request('trashed') )
                    <p class="p2 status {{ $page->status }}">{{ Str::title( $page->status ) }}</p>
                    @endif
                </div>
                <div class="actions">
                    @if( request('trashed') )
                    <form method="post" action="{{ route( 'admin.pages.restore', $page ) }}">
                        @csrf
                        <button type="submit">{{ __('Restore') }}</button>
                    </form>
                    <form method="post" action="{{ route( 'admin.page.destroy', $page ) }}">
                        @csrf
                        @method('delete')
                        <button class="danger" type="submit">{{ __('Delete Permanently') }}</button>
                    </form>
                    @else
                    <form method="post" action="{{ route( 'admin.pages.trash', $page ) }}">
                        @csrf
                        @method('delete')
                        <a href="{{ route( 'admin.pages.edit', [ 'page' => $page ] ) }}" class="button">{{ __('Edit') }}</a>
                        <button type="submit">{{ __('Trash') }}</button>
                    </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{ $pages->links() }}

    </div>

</div>

</x-admin::htmldoc>
