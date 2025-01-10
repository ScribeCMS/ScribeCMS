@use('App\Enums\UserRole')
<x-admin::htmldoc doctitle="{{ __('Create User') }}" bodyClass="context-create-user">
<x-admin::sidebar />

<div class="main">

    <div class="header">
        <h1>Create User</h1>
    </div>

    <div class="workspace">

        <form
            method="post"
            action="{{ route('admin.users.store') }}"
            name="create-user"
            id="create-user"
            class="create-user grid"
        >
            @csrf
            @method('put')

            <label for="first_name">{{ __('First Name') }} ({{ __('required') }})</label>
            <input name="first_name" id="first_name" type="text" value="{{ old('first_name') }}" class="@error('first_name') form-input-error @enderror" required />
            @error('first_name')
                <p class="p3 error">{{ $message }}</p>
            @enderror

            <label for="last_name">{{ __('Last Name') }} ({{ __('required') }})</label>
            <input name="last_name" id="last_name" type="text" value="{{ old('last_name') }}" class="@error('last_name') form-input-error @enderror" required />
            @error('last_name')
                <p class="p3 error">{{ $message }}</p>
            @enderror

            <label for="display_name">{{ __('Display Name') }}</label>
            <input name="display_name" id="display_name" type="text" value="{{ old('display_name') }}" />

            <label for="email">{{ __('Email Address') }} ({{ __('required') }})</label>
            <input name="email" id="email" type="email" value="{{ old('email') }}" class="@error('email') form-input-error @enderror" required />
            @error('email')
                <p class="p3 error">{{ $message }}</p>
            @enderror

            <label for="">{{ __('Password') }} ({{ __('required') }})</label>
            <input name="password" id="password" type="password" class="@error('password') form-input-error @enderror" required />
            @error('password')
                <p class="p3 error">{{ $message }}</p>
            @enderror

            <label for="role">{{ __('Role') }} ({{ __('required') }})</label>
            <select name="role" id="role" class="@error('role') form-input-error @enderror" required>
            @foreach( UserRole::cases() as $role )
                <option value="{{ $role }}" @selected($role->value === old('role'))>
                    {{ $role }}
                </option>
            @endforeach
            </select>

            <label for="website">{{ __('Website') }}</label>
            <input name="website" id="website" type="url" value="{{ old('website') }}" />

            <p><button class="primary" type="submit">{{ __('Create User') }}</button></p>

        </form>

    </div>

</div>

</x-admin::htmldoc>
