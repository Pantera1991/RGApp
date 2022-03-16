@extends('layouts.app')

@section('content')

    <div class="container">
        <header>
            <h1>{{ __('Add new post') }}</h1>
        </header>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body justify-content-center">
                        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row mb-3">
                                <label for="title" class="col-md-3 col-form-label text-md-end">
                                    {{ __('Title') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="title"
                                           type="text"
                                           maxlength="60"
                                           minlength="3" class="form-control @error('title') is-invalid @enderror"
                                           name="title"
                                           value="{{ old('title') }}"
                                           autocomplete="title"
                                           required autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="author" class="col-md-3 col-form-label text-md-end">
                                    {{ __('Author') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="author"
                                           type="text"
                                           maxlength="100"
                                           minlength="3"
                                           class="form-control @error('author') is-invalid @enderror"
                                           name="author"
                                           value="{{ old('author') }}"
                                           autocomplete="author" required>

                                    @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="content" class="col-md-3 col-form-label text-md-end">
                                    {{ __('Content') }}
                                </label>

                                <div class="col-md-6">
                                    <textarea id="content"
                                           type="text"
                                           minlength="3"
                                           class="form-control @error('content') is-invalid @enderror"
                                           name="content"
                                           autocomplete="author"  required>
                                        {{ old('content') }}
                                    </textarea>

                                    @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/post.js') }}"></script>
@endsection
