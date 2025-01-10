@php
use App\Models\User;

$users = User::select('id', 'first_name', 'last_name')->get();
@endphp

<x-admin::htmldoc doctitle="Create Post">
<x-admin::sidebar />

<div class="main">

<div class="workspace">

    <form
        method="post"
        action="{{ route('admin.posts.store') }}"
        name="create-post"
        id="create-post"
    >
    @csrf
    @method( 'PUT' )
    </form>

    <div class="cell full">
        <label for="title" class="screen-reader-text">Post Title</label>
        <textarea name="title" form="create-post" id="title" placeholder="Add a title" class="title"></textarea>
        @error('title')
            {{ $message }}
        @enderror
    </div>

    <div class="cell full">
        <label for="title" class="screen-reader-text">Post Content</label>
        <textarea name="body" form="create-post" id="body" placeholder="Once upon a time..." class="body"></textarea>
    </div>

</div>

<div class="drawer">
    <div class="cell full">
        <button type="submit" form="create-post" value="Create Post">Create Post</button>
    </div>

    <div class="cell full">
        <p><label for="slug">Slug</label></p>
        <p><input type="text" form="create-post" name="slug" id="slug" /></p>
        <p class="desc">If blank, a slug will be generated from the Post Title</p>
        @error('slug')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div class="cell full">
        <p><label for="user_id">Author</label></p>

        <p><select name="user_id" form="create-post" id="user_id">
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
        <p><input type="datetime-local" form="create-post" name="published_at" id="published_at" class="" />
{{ config( 'app.timezone' ) }}</p>
        @error('published_at')
            <p>{{ $message }}</p>
        @enderror
    </div>
</div>

</div>

</x-admin::htmldoc>
