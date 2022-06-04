@props([
    'post'
])
<div class="post-preview">
    <a href="{{ route('posts.show', $post) }}">
        <h2 class="post-title">{{ $post->title }}</h2>
    </a>
    <p>
        {{ Str::limit($post->description, 200, '...') }}
    </p>
    <p class="post-meta">
        Posted by
        <a href="javascript:;">{{ $post->user->name ?? NULL }}</a>
        on {{ $post->publication_date->format('jS F, Y') }}
    </p>
</div>