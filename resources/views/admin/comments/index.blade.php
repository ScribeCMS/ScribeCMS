<x-admin::htmldoc doctitle="Comments">
<x-admin::sidebar />

<div class="main">

    <div class="header">
        <h1>{{ __('Comments') }}</h1>
    </div>

    <div class="workspace">

        <div class="cards">
            @foreach( $comments as $comment )
            <div class="card">
                <div class="info">
                    <p>{{ $comment->body }}</p>
                    <p class="p2 data">By {{ $comment->name }} - {{ $comment->created_at->format('F j, Y') }}</p>
                    @if( ! request('trashed') )
                    <p class="p2 status {{ $comment->status }}">{{ Str::title( $comment->status ) }}</p>
                    @endif
                </div>
                <div class="actions">
                    @if( request('status') === 'trashed' )
                    <form method="post" action="{{ route( 'admin.comments.restore', $comment ) }}">
                        @csrf
                        <button type="submit">Restore</button>
                    </form>
                    <form method="post" action="{{ route( 'admin.comments.destroy', $comment ) }}">
                        @csrf
                        @method('delete')
                        <button class="danger" type="submit">Delete Permanently</button>
                    </form>
                    @else
                    <form method="post" action="{{ route( 'admin.comments.trash', $comment ) }}">
                        @csrf
                        @method('delete')
                        <a href="{{ route( 'admin.comments.edit', [ 'comment' => $comment ] ) }}" class="button">Edit</a>
                        <button type="submit">Trash</button>
                    </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{ $comments->links() }}

    </div>

</div>

</x-admin::htmldoc>
