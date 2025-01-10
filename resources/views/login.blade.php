<x-admin::htmldoc doctitle="Login" bodyClass="context-login">

<form name="login" action="{{ route( 'login.auth' ) }}" method="post" id="login-form">
    @csrf
    @method('PUT')

    <h1>{{ config('app.name') }}</h1>

    <label>
        {{ __('Email Address') }}<br />
        <input type="email" name="email" value="{{ old('email') }}" />
    </label>

    @error('email')
    <p class="p3 error">{{ $message }}</p>
    @enderror

    <label>
        {{ __('Password') }}<br />
        <input type="password" name="password" autocomplete="off" />
    </label>

    <label><input type="checkbox" name="remember" autocomplete="off" /> {{ __( 'Remember Me' ) }}</label>

    <button type="submit" class="primary">Log In</button>
</form>

</x-admin::htmldoc>
