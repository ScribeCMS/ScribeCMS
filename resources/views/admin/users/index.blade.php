<x-admin::htmldoc doctitle="Dashboard">
<x-admin::sidebar />

<div class="main">

    <div class="header">
        <h1>{{ __('Users') }}</h1>
        <div class="actions">
            <a class="button primary" href="{{ route('admin.users.create') }}">{{ __('Create New') }}</a>
        </div>
    </div>

    <div class="workspace">

        @if( session('success') )
            <p class="alert">
                {{ session('success') }}
            </p>
        @endif

        <div class="cards">
            @foreach( $users as $user )
            <div class="card">
                <div class="avatar">
                    <x-admin::icons.user />
                </div>
                <div class="info">
                    <h4><a target="_blank" href="{{ $user->url }}">{{ $user->display_name }}</a></h4>
                    <p class="p2 data">Owner</p>
                </div>
                <div class="actions">
                    <a href="{{ route( 'admin.users.edit', [ 'user' => $user ] ) }}" class="button">Edit</a>
                </div>
            </div>
            @endforeach
        </div>

        <p>{{ $users->links() }}</p>

    </div>
</div>

</x-admin.htmldoc>
