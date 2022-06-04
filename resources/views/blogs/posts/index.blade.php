@extends('layouts.public.app')

@section('title', 'My Posts')

@section('content')

    <div class="container">
        @if (session('success'))
        <div class="row justify-content-center">
            <div class="col-md-8 mt-2 mb-3">
                <x-alert type="success">{{ session('success') }}</x-alert>
            </div>
        </div>
        @endif
        
        @if ($posts->isNotEmpty())
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h4 class="mb-4 text-muted">My Posts</h4>

                    <div class="text-end">
                        <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">New Post</a>
                    </div>
                    
                    <x-blog.sorter :sortParams="$sortParams" :sortOrders="$sortOrders"></x-blog.sorter>
                    
                    @foreach ($posts as $post)
                        <x-blog.preview :post="$post"></x-blog.preview>
                    @endforeach
                    <div class="my-5">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
            
        @else
            <div class="my-5 text-center">
                <h1 class="text-muted fs-1">You are yet to make a post</h1>
                <a href="{{ route('posts.create') }}" class="btn btn-primary btn-lg mt-4 px-4">
                    Make a Post
                </a>
            </div>
        @endif
    </div>
@endsection