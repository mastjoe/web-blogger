@extends('layouts.public.app')

@section('title', $post->title)

@section('content')
    <header class="masthead" style="background-image: url('assets/images/bloggy.jpeg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>{{ $post->title }}</h1>
                        <div class="text-start">
                            <span class="subheading mt-4">{{ $post->publication_date->format('jS F, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
        
                <h3 class="fs-3">
                    {{ $post->title }}
                </h3>

                <div class="text-center text-muted my-3">
                    <span><b>{{ $post->user->name ?? NULL }}</b></span> .
                    <span class="fw-bold">{{ $post->publication_date->format('F j, Y @ h:i a') }}</span>
                </div>

                <div class="my-5">
                    {{ $post->description }}
                </div>

                <div class="my-5 text-end">
                    <a href="{{ route('home') }}" class="btn btn-light">See other Posts</a>
                </div>
            </div>
        </div>
    </div>
@endsection