@extends('layouts.app')

@section('content')
    <div class="container">
        @include("helper.message")
        <header class="d-flex justify-content-between align-items-center">
            <h1>{{__('List of post')}}</h1>
            <a class="btn btn-outline-primary" href="{{route('post.create')}}">{{__('Add new post')}}</a>
        </header>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="mb-4 mt-4">
                    <form class="d-flex justify-content-between align-items-center flex-wrap"
                          method="GET"
                          action="{{ route('post.search') }}">
{{--                        @csrf--}}
                        <div class="d-flex gap-2">
                            <div class="mb-3">
                                <label for="searchTitle" class="form-label">{{__('Search title')}}</label>
                                <input id="searchTitle"
                                       class="form-control me-2"
                                       type="search"
                                       name="title"
                                       placeholder="Type title of post"
                                       aria-label="Title"
                                       value="{{ old('title') }}">
                            </div>

                            <div class="mb-3">
                                <label for="searchAuthor" class="form-label">{{__('Search author')}}</label>
                                <input id="searchAuthor"
                                       class="form-control me-2"
                                       type="search"
                                       name="author"
                                       placeholder="Type author of post"
                                       aria-label="Author"
                                       value="{{ old('author') }}">
                            </div>

                            @if($sortable)
                                @include('helper.sortable')
                            @endif
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-outline-success" type="submit">Filter</button>
                            @if (\Request::is('admin/post/search'))
                                <a href="{{ route('post.index') }}" class="btn btn-outline-dark">Clear</a>
                            @endif
                        </div>
                    </form>

                </div>
                <div class="card">
                    <div class="card-body">
                        @if($posts->count() === 0)
                            @include('helper.empty.data')
                        @else
                            @include('admin.post.list')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
