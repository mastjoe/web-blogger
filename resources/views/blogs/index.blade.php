@extends('layouts.public.app')

@section('title', 'Welcome')

@section('content')
    <header class="masthead" style="background-image: url('assets/images/bloggy.jpeg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Hub of Great Web Content</h1>
                        <span class="subheading mt-4 text-primary">A Web Blog Platform</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            @if ($posts->isNotEmpty())

            
            <div class="col-md-10 col-lg-8 col-xl-7">
                
                    <x-blog.sorter :sortParams="$sortParams" :sortOrders="$sortOrders"></x-blog.sorter>

                    @foreach ($posts as $post)
                        <x-blog.preview :post="$post"></x-blog.preview>
                    @endforeach

                    <div class="my-5">
                        {{ $posts->links() }}
                    </div>
                </div>
            @else
                <div class="col-12">
                    <div class="my-5 text-center">
                        <h1 class="text-muted">
                            No post made yet
                        </h1>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection