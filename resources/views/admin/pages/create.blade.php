@php
use App\Models\User;

$users = User::select('id', 'first_name', 'last_name')->get();
@endphp

<x-admin::htmldoc doctitle="Create Page" bodyClass="context-edit-content context-create-page">
<x-admin::sidebar />

<div class="main noheader withdrawer">

    <div class="workspace">

        <form
            method="post"
            action="{{ route('admin.pages.store') }}"
            name="create-page"
            id="create-page"
        >
        @csrf
        @method( 'PUT' )
        </form>

        <div class="cell full">
            <label for="title" class="screen-reader-text">Page Title</label>
            <textarea name="title" form="create-page" id="title" placeholder="Add a title" class="title"></textarea>
            @error('title')
                {{ $message }}
            @enderror
        </div>

        <div class="cell full">
            <label for="title" class="screen-reader-text">Page Content</label>
            <textarea name="body" form="create-page" id="body" placeholder="Once upon a time..." class="body"></textarea>
        </div>

    </div>

    <div class="drawer">
        <div class="cell full">
            <button type="submit" form="create-page" value="Create Page" class="primary">Create Page</button>
        </div>

        <div class="cell full">
            <p><label for="slug">Slug</label></p>
            <p><input type="text" form="create-page" name="slug" id="slug" /></p>
            <p class="desc">{{ __('If blank, a slug will be generated from the Title') }}</p>
            @error('slug')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="cell full">
            <p><label for="user_id">Author</label></p>

            <p><select name="user_id" form="create-page" id="user_id">
            @foreach( $users as $user )
                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
            @endforeach
            </select>
            </p>
            @error('user_id')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="cell full">
            <p><label for="published_at">Date/Time Published</label></p>
            <p><input type="datetime-local" form="create-page" name="published_at" id="published_at" class="" />
    {{ config( 'app.timezone' ) }}</p>
            @error('published_at')
                <p>{{ $message }}</p>
            @enderror
        </div>
    </div>

</div>

</x-admin::htmldoc>
