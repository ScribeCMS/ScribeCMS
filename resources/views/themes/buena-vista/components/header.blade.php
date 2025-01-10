<header class="site-header">
    <h1 class="site-title"><a href="{{ url('/') }}">{{ config('app.name') }}</a></h1>

    <nav class="site-navigation">
        <ul>
            <li><a @class([ 'active' => request()->is('/') ]) href="{{ url('/') }}">{{ __('Home') }}</a></li>
            <li><a href="#">{{ __('About') }}</a></li>
            <li><a href="#">{{ __('Contact') }}</a></li>
        </ul>
    </nav>
</header>
