@php
use Illuminate\Support\Str;

use App\Models\User;
use App\Enums\PageStatus;

$users = User::select('id', 'first_name', 'last_name')->get();
@endphp

<x-admin::htmldoc doctitle="Edit Page" bodyClass="context-edit-content context-edit-page">
<x-admin::sidebar />

<div class="main noheader withdrawer ">

    <div class="workspace">

        <form
            method="post"
            action="{{ route('admin.pages.update', $page) }}"
            name="edit-page"
            id="edit-page"
        >
        @csrf
        @method('patch')
        </form>

        <div class="cell full">
            <label for="title" class="screen-reader-text">Page Title</label>
            <textarea name="title" form="edit-page" id="title" placeholder="Add a title" class="title">{{ $page->title }}</textarea>
            @error('title')
                {{ $message }}
            @enderror
        </div>

        <div class="cell full">
            <label for="title" class="screen-reader-text">Page Content</label>
            <textarea name="body" form="edit-page" id="body" placeholder="Once upon a time..." class="body">{{ $page->body }}</textarea>
        </div>

    </div>

    <div class="drawer">
        <div class="cell full">
            <button type="submit" form="edit-page" value="Create Page" class="primary">Save Page</button>
        </div>

        <div class="cell full">
            <p><label for="slug">Slug</label></p>
            <p><input type="text" form="edit-page" name="slug" id="slug" value="{{ $page->slug }}" /></p>
            <p class="desc">{{ __('If blank, a slug will be generated from the Title') }}</p>
            @error('slug')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="cell full">
            <p><label for="user_id">Author</label></p>

            <p><select name="user_id" form="edit-page" id="user_id">
            @foreach( $users as $user )
                <option value="{{ $user->id }}" {{ $user->id === $page->user_id ? 'selected' : '' }}>
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
            <p><label for="status">{{ __('Status') }}</label></p>
            <p>
                <select name="status" form="edit-page" id="status">
                    @foreach( PageStatus::cases() as $status )
                    <option value="{{ $status->value }}" @selected( $status->value == $page->status )>{{ Str::title($status->value) }}</option>
                    @endforeach
                </select>
            </p>
        </div>

        <div class="cell full">
            <p><label for="published_at">Published on</label></p>
            <p><input type="datetime-local" form="edit-page" name="published_at" id="published_at" class="" value="{{ $page->published_at }}" />
    {{ config( 'app.timezone' ) }}</p>
            @error('published_at')
                <p>{{ $message }}</p>
            @enderror
        </div>
    </div>

</div>

</x-admin::htmldoc>
