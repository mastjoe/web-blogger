@extends('layouts.public.app')
@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body bg-light">
            <h3 class="mb-5">
                @if (now()->format('H') < 12)
                    Good Morning!
                @elseif (now()->format('H') >= 12 && now()->format('H') < 16)
                    Good Day
                @else
                    Good Evening
                @endif
            </h3>
            <h4 class="text-secondary">Welcome {{ ucwords(strtolower(auth()->user()->name)) }}</h4>
            <p class="text-end">
                <a href="#" class="text-decoration-none text-muted">Dashboard</a> | 
                <a href="{{ route('posts.index') }}">my posts</a>
            </p>
        </div>
    </div>
</div>
@endsection

