@use('App\Enums\UserRole')
<x-admin::htmldoc doctitle="{{ __('Edit User Password') }}" bodyClass="context-edit-user-password">
<x-admin::sidebar />

<div class="main">

    <div class="header">
        <h1>Edit User Password</h1>
    </div>

    <div class="workspace">

        <form
            method="post"
            action="{{ route('admin.users.updatepassword', $user) }}"
            name="edit-user"
            id="edit-user"
            class="edit-user grid"
        >
            @csrf
            @method('patch')

            <label for="password">{{ __('New Password') }} ({{ __('required') }})</label>
            <input name="password" id="password" type="password" class="@error('password') form-input-error @enderror" required />
            @error('password')
                <p class="p3 error">{{ $message }}</p>
            @enderror

            <label for="password_confirmation">{{ __('Confirm New Password') }} ({{ __('required') }})</label>
            <input name="password_confirmation" id="password_confirmation" type="password" class="@error('password_confirmation') form-input-error @enderror" required />
            @error('password_confirmation')
                <p class="p3 error">{{ $message }}</p>
            @enderror

            <p><button class="primary" type="submit">{{ __('Change Password') }}</button></p>

        </form>

    </div>

</div>

</x-admin::htmldoc>
