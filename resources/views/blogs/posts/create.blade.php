@extends('layouts.public.app')

@section('title', 'New Post')

@section('content')
    <div class="container">
        <div class="row my-5 justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('posts.store') }}" method="POST">
                    @if ($errors->any())
                        <x-alert type="danger" dismissable>{{ $errors->first() }}</x-alert>
                    @endif
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <x-form.input
                            name="title"
                            id="title"
                            value="{{ old('title') }}"
                            required
                        ></x-form.input>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <x-form.textarea
                            name="description"
                            id="description"
                            rows="4"
                            required
                        >{{ old('description') }}</x-form.textarea>
                    </div>

                    <div class="mb-3">
                        <label for="publication_date" class="form-label">Publication Date</label>
                        <x-form.input
                            id="publication_date"
                            name="publication_date"
                            required
                            type="datetime-local"
                            value="{{ old('publication_date') ?? now()->format('Y-m-d\TH:i:s') }}"
                        ></x-form.input>
                    </div>

                    <div class="my-4">
                        <button class="btn btn-primary btn-lg w-100" type="submit">
                            Save Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection