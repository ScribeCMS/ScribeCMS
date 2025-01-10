@use('App\Enums\UserRole')
<x-admin::htmldoc doctitle="{{ __('Edit User') }}" bodyClass="context-edit-user">
<x-admin::sidebar />

<div class="main">

    <div class="header">
        <h1>Edit User</h1>
        <div class="actions">
            <button class="primary" type="submit" form="edit-user">{{ __('Save') }}</button>
        </div>
    </div>

    <div class="workspace">
        @if ( $errors->any() )
            @foreach( $errors->all() as $error )
                <p class="error">{{ $error }}</p>
            @endforeach
        @endif

        <form
            method="post"
            action="{{ route('admin.users.update', $user) }}"
            name="edit-user"
            id="edit-user"
            class="edit-user grid"
        >
            @csrf
            @method('patch')

            <label for="first_name">{{ __('First Name') }} ({{ __('required') }})</label>
            <input name="first_name" id="first_name" type="text" value="{{ $user->first_name }}" class="@error('first_name') form-input-error @enderror" required />
            @error('first_name')
                <p class="p3 error">{{ $message }}</p>
            @enderror

            <label for="last_name">{{ __('Last Name') }} ({{ __('required') }})</label>
            <input name="last_name" id="last_name" type="text" value="{{ $user->last_name }}" class="@error('last_name') form-input-error @enderror" required />
            @error('last_name')
                <p class="p3 error">{{ $message }}</p>
            @enderror

            <label for="display_name">{{ __('Display Name') }}</label>
            <input name="display_name" id="display_name" type="text" value="{{ $user->display_name }}" />

            <label for="email">{{ __('Email Address') }} ({{ __('required') }})</label>
            <input name="email" id="email" type="email" value="{{ $user->email }}" class="@error('email') form-input-error @enderror" required />
            @error('email')
                <p class="p3 error">{{ $message }}</p>
            @enderror

            <label>{{ __('Password') }}</label>
            <p><a class="button" href="{{ route('admin.users.editpassword', $user) }}">{{ __('Update Password') }}</a></p>

            <label for="role">{{ __('Role') }} ({{ __('required') }})</label>
            <select name="role" id="role" class="@error('first_name') form-input-error @enderror" required>
            @foreach( UserRole::cases() as $role )
                <option value="{{ $role }}" @selected($role->value === $user->role)>
                    {{ $role }}
                </option>
            @endforeach
            </select>
            @error('role')
                <p class="p3 error">{{ $message }}</p>
            @enderror

            <label for="avatar">{{ __('Avatar') }}</label>
            <input name="avatar" id="avatar" type="url" value="{{ $user->avatar }}" />

            <label for="cover">{{ __('Cover Photo') }}</label>
            <input name="cover" id="cover" type="url" value="{{ $user->cover }}" />

            <label for="website">{{ __('Website') }}</label>
            <input name="website" id="website" type="url" value="{{ $user->website }}" />

            <label for="bio">{{ __('Bio') }}</label>
            <textarea name="bio" id="bio">{{ $user->bio }}</textarea>

            <label for="archive_title">{{ __('Archive Title') }}</label>
            <input name="archive_title" id="archive_title" value="{{ $user->archive_title }}" />

            <label for="archive_bio">{{ __('Archive Bio') }}</label>
            <textarea name="archive_bio" id="archive_bio" type="text">{{ $user->archive_bio }}</textarea>

            <label for="archive_doctitle">{{ __('Archive Document Title') }}</label>
            <input name="archive_doctitle" id="archive_doctitle" type="text" value="{{ $user->archive_doctitle }}" />

            <label for="archive_metadesc">{{ __('Archive Meta Description') }}</label>
            <textarea name="archive_metadesc" id="archive_metadesc">{{ $user->archive_metadesc }}</textarea>

            <p><button class="primary" type="submit" form="edit-user">{{ __('Save') }}</button></p>

            <label for="delete-user">{{ __('Delete User') }}</label>
            <p><button type="submit" class="danger" form="delete-user">{{ __('Delete User') }}</button></p>

        </form>

        <form method="post" action="{{ route( 'admin.users.destroy', $user ) }}" name="delete-user" id="delete-user">
            @csrf
            @method('delete')
        </form>

    </div>

</div>

</x-admin::htmldoc>
