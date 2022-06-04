@extends('layouts.public.auth-app')

@section("title", "Sign Up")

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="text-center">
                    <h4 class="my-4">
                        <a class="navbar-brand text-dark fw-bold" href="{{ route('home') }}">WEB BLOGGER</a>
                    </h4>
                    <h6 class="fw-bold text-muted">Sign Up</h6>
                </div>
                <form action="{{ route('register') }}" method="POST">
                    @if ($errors->any())
                        <x-alert type="danger" dismissable>{{ $errors->first() }}</x-alert>
                    @endif
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <x-form.input
                            type="text"
                            id="name"
                            value="{{ old('name') }}"
                            required
                            name="name"
                        ></x-form.input>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <x-form.input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                        ></x-form.input>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <x-form.input
                            type="password"
                            id="password"
                            name="password"
                            required
                        ></x-form.input>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <x-form.input
                            type="password"
                            id="confirm_password"
                            name="password_confirmation"
                            required
                        ></x-form.input>
                    </div>
                    <div class="mb-3 mt-2">
                        <button class="btn btn-primary btn-lg w-100" type="submit">
                            Sign Up
                        </button>
                    </div>
                    <p class="text-muted my-4">Already signed up, log in <a class="text-decoration-none" href="{{ route('login') }}">here</a></p>
                </form>
            </div>
        </div>
    </div>
@endsection