@extends('layouts.app')

@section('content')
    <div class="container">
        <header>
            <h1>{{ __('Add new comment') }}</h1>
        </header>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body justify-content-center">
                        <form method="POST" action="{{ route('comments.store') }}" enctype="multipart/form-data">
                            @csrf

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
                                              maxlength="500"
                                              class="form-control @error('content') is-invalid @enderror"
                                              name="content"
                                              autocomplete="content"
                                              required>
                                        {{ old('content') }}
                                    </textarea>

                                    @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="post_id" class="col-md-3 col-form-label text-md-end">
                                    {{ __('Post') }}
                                </label>

                                <div class="col-md-6">
                                    <select id="post_id"
                                            class="form-select @error('post_id') is-invalid @enderror"
                                            name="post_id"
                                            required
                                            autofocus>
                                        @foreach($posts as $post)
                                            <option value="{{$post->id}}">
                                                {{ $post->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('post_id')
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
