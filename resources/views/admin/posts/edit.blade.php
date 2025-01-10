@php
use App\Models\User;

$users = User::select('id', 'first_name', 'last_name')->get();
@endphp

<x-admin::htmldoc doctitle="Edit Post" bodyClass="context-edit-content context-edit-post">
<x-admin::sidebar />

<div class="main noheader withdrawer">

    <div class="workspace">

        <form
            method="post"
            action="{{ route('admin.posts.update', $post) }}"
            name="edit-post"
            id="edit-post"
        >
        @csrf
        @method('patch')
        </form>

        <div class="cell full">
            <label for="title" class="screen-reader-text">Post Title</label>
            <textarea name="title" form="edit-post" placeholder="Add a title" class="title">{{ $post->title }}</textarea>
            @error('title')
                {{ $message }}
            @enderror
        </div>

        <div class="cell full">
            <label for="title" class="screen-reader-text">Post Content</label>
            <textarea name="body" form="edit-post" id="body" placeholder="Once upon a time..." class="body">{{ $post->body }}</textarea>
        </div>

    </div>

    <div class="drawer">
        <div class="cell full">
            <button type="submit" form="edit-post" value="Create Post" class="primary">Save Post</button>
        </div>

        <div class="cell full">
            <p><label for="slug">Slug</label></p>
            <p><input type="text" form="edit-post" name="slug" id="slug" value="{{ $post->slug }}" /></p>
            <p class="desc">If blank, a slug will be generated from the Post Title</p>
            @error('slug')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="cell full">
            <p><label for="user_id">Author</label></p>

            <p><select name="user_id" form="edit-post" id="user_id">
            @foreach( $users as $user )
                <option value="{{ $user->id }}" {{ $user->id === $post->user_id ? 'selected' : '' }}>
                    {{ $user->first_name }} {{ $user->last_name }}
                </option>
            @endforeach
            </select>
            </p>
            @error('user_id')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="cell full">
            <p><label for="status">Status</label></p>
            <p>
                <select name="status" form="edit-post" id="status">
                    @foreach( [ 'Published' => 'published', 'Draft' => 'draft' ] as $label => $value )
                    <option value="{{ $value }}" {{ $value === $post->status ?'selected' : '' }} >{{ $label }}</option>
                    @endforeach
                </select>
            </p>
        </div>

        <div class="cell full">
            <p><label for="published_at">Published on</label></p>
            <p><input type="datetime-local" form="edit-post" name="published_at" id="published_at" class="" value="{{ $post->published_at }}" />
    {{ config( 'app.timezone' ) }}</p>
            @error('published_at')
                <p>{{ $message }}</p>
            @enderror
        </div>
    </div>

</div>

</x-admin::htmldoc>
