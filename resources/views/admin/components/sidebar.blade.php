<div class="sidebar">
    <form action="{{ route('logout') }}" method="post" id="logout-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>
    <div class="user">
        <img src="{{ auth()->user()->avatar ?: 'https://dummyimage.com/50x50' }}" width="50" height="50" />
        <p class="name">
            {{ auth()->user()->display_name }}<br />
            <button form="logout-form" type="submit">{{ __('Log out') }}</button>
        </p>
    </div>

    <nav class="primary">
        <ul class="menu">
            <li @class(
                [
                    'dashboard',
                    'active' => request()->routeIs('admin.dashboard'),
                ]
            )>
                <a href="{{ route('admin.dashboard') }}">
                    <x-admin::icons.rectangle-group />
                    {{ __( 'Dashboard' ) }}
                </a>
            </li>
            <li class="site">
                <a href="{{ route('home') }}" target="_blank">
                    <x-admin::icons.window />
                    {{ __( 'View Site' ) }}
                    <span class="context-icon"><x-admin::icons.arrow-top-right-on-square /></span>
                </a>
            </li>
        </ul>
        <h3>Content</h3>
        <ul class="menu">
            <li @class(
                [
                    'pages',
                    'active' => request()->routeIs('admin.pages.*'),
                ]
            )>
                <a href="{{ route('admin.pages.index') }}">
                    <x-admin::icons.document />
                    {{ __( 'Pages' ) }}
                </a>
            </li>
            <li @class(
                [
                    'posts',
                    'active' => request()->routeIs('admin.posts.*'),
                ]
            )>
                <a href="{{ route( 'admin.posts.index' ) }}">
                    <x-admin::icons.pencil />
                    {{ __( 'Posts' ) }}
                </a>
                <ul>
                    <li @class(
                        [
                            'tags',
                            'active' => request()->routeIs('admin.tags.*'),
                        ]
                    )>
                        <a href="{{-- route('admin.tags.index') --}}">
                            <x-admin::icons.tag />
                            {{ __( 'Tags' ) }}
                        </a>
                    </li>
                    <li @class(
                        [
                            'comments',
                            'active' => request()->routeIs('admin.comments.*'),
                        ]
                    )>
                        <a href="{{ route('admin.comments.index') }}">
                            <x-admin::icons.comment />
                            {{ __( 'Comments' ) }}
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <h3>Site</h3>
        <ul class="menu">
            <li @class(
                [
                    'users',
                    'active' => request()->routeIs('admin.users.*'),
                ]
            )>
                <a href="{{ route( 'admin.users.index' ) }}">
                    <x-admin::icons.users />
                    {{ __( 'Users' ) }}
                </a>
            </li>
            <li class="settings">
                <a href="">
                    <x-admin::icons.gear-6-tooth />
                    {{ __( 'Settings' ) }}
                </a>
            </li>
        </ul>
    </nav>

    <div class="scribe">
        <p><a href="https://github.com/scribecms" target="_blank"><img src="{{ route( 'admin.assets', ['file' => 'img/scribe.png'] ) }}" width="200px" height="auto" /></a></p>
        <p class="p2">v0.0.1-alpha-1</p>
    </div>
</div>
