@extends('layouts.public.auth-app')

@section("title", "Login")

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="text-center">
                    <h4 class="my-4">
                        <a class="navbar-brand text-dark fw-bold" href="{{ route('home') }}">WEB BLOGGER</a>
                    </h4>
                    <h6 class="fw-bold text-muted">LOGIN</h6>
                </div>
                <form action="{{ route('login') }}" method="POST">
                    @if ($errors->any())
                        <x-alert type="danger" dismissable>{{ $errors->first() }}</x-alert>
                    @endif
                    
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <x-form.input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            autocomplete="off"
                        ></x-form.input>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <x-form.input
                            type="password"
                            name="password"
                            id="password"
                        ></x-form.input>
                    </div>
                    <div class="mb-3 mt-2">
                        <button class="btn btn-primary btn-lg w-100" type="submit">
                            Login
                        </button>
                    </div>
                    <p class="text-muted my-4">Not signed up yet, Sign up <a class="text-decoration-none" href="{{ route('register') }}">here</a></p>
                </form>
            </div>
        </div>
    </div>
@endsection