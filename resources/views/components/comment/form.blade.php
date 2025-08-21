@props([
    'post',
    'heading' => __( 'Leave a Reply' ),
    'submitText' => __( 'Submit Comment' ),
])
<div {{ $attributes->merge([ 'id' => 'respond' ]) }}>
    <h3>{{ $heading }}</h3>
    <form method="post" action="{{ route( 'public.comments.store', [ 'post' => $post ] ) }}" class="comment-form" name="comment-form">
        @csrf
        @method('PUT')

        @auth
        <p>{{ __( 'Logged in as :display_name', [ 'display_name' => auth()->user()->display_name ] ) }}</p>
        <input type="hidden" name="name" value="{{ auth()->user()->display_name }}" />
        <input type="hidden" name="email" value="{{ auth()->user()->email }}" />
        <input type="hidden" name="url" value="{{ auth()->user()->website }}" />
        @endauth

        <textarea class="comment-form-body" name="body" rows="8" cols="45" required></textarea>

        @guest
        <label for="comment-form-name">{{ __( 'Name (required)' ) }}</label>
        <input type="text" class="comment-form-name" id="comment-form-name" name="name" required />

        <label for="comment-form-email">{{ __( 'Email (required)' ) }}</label>
        <input type="email" class="comment-form-email" id="comment-form-email" name="email" required />

        <label for="comment-form-url">{{ __( 'Website' ) }}</label>
        <input type="url" class="comment-form-url" id="comment-form-url" name="url" />
        @endguest

        <button type="submit">{{ $submitText }}</button>
    </form>
</div>
