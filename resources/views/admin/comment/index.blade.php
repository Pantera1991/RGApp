@extends('layouts.app')

@section('content')
    <div class="container">
        @include("helper.message")
        <header class="d-flex justify-content-between align-items-center">
            <h1>{{__('List of comment')}}</h1>
            <a class="btn btn-outline-primary" href="{{route('comments.create')}}">{{__('Add new comment')}}</a>
        </header>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="mb-4 mt-4">
                    <form class="d-flex justify-content-between align-items-center flex-wrap"
                          method="GET"
                          action="{{ route('comments.search') }}">
                        <div class="d-flex gap-2">
                            <div class="mb-3">
                                <label for="searchContent" class="form-label">{{__('Search content')}}</label>
                                <input id="searchContent"
                                       class="form-control me-2"
                                       type="search"
                                       name="content"
                                       placeholder="content"
                                       aria-label="Title"
                                       value="{{ old('content') }}">
                            </div>

                            <div class="mb-3">
                                <label for="searchAuthor" class="form-label">{{__('Search author')}}</label>
                                <input id="searchAuthor"
                                       class="form-control me-2"
                                       type="search"
                                       name="author"
                                       placeholder="author"
                                       aria-label="Author"
                                       value="{{ old('author') }}">
                            </div>

                            <div class="mb-3">
                                <label for="searchPostId" class="form-label">{{__('Search post id')}}</label>
                                <input id="searchPostId"
                                       class="form-control me-2"
                                       type="search"
                                       name="post_id"
                                       placeholder="post id"
                                       aria-label="Post id"
                                       value="{{ old('post_id') }}">
                            </div>

                            @if($sortable)
                                @include('helper.sortable')
                            @endif
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-outline-success" type="submit">Filter</button>
                            @if (\Request::is('admin/comments/search'))
                                <a href="{{ route('comments.index') }}" class="btn btn-outline-dark">Clear</a>
                            @endif
                        </div>
                    </form>

                </div>
                <div class="card">
                    <div class="card-body">
                        @if($comments->count() === 0)
                            @include('helper.empty_data')
                        @else
                            @include('admin.comment.list')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
