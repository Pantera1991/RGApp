@extends('layouts.app')

@section('content')
    <div class="container">
        @include("helper.message")
        <header class="d-flex justify-content-between align-items-center">
            <h1>{{__('List of user')}}</h1>
            <a class="btn btn-outline-primary" href="{{route('users.create')}}">{{__('Add new user')}}</a>
        </header>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="mb-4 mt-4">
                    <form class="d-flex justify-content-between align-items-center flex-wrap"
                          method="GET"
                          action="{{ route('users.search') }}">
                        <div class="d-flex gap-2">
                            <div class="mb-3">
                                <label for="searchEmail" class="form-label">{{__('Search email')}}</label>
                                <input id="searchEmail"
                                       class="form-control me-2"
                                       type="search"
                                       name="email"
                                       placeholder="email"
                                       aria-label="Email"
                                       value="{{ old('email') }}">
                            </div>

                            <div class="mb-3">
                                <label for="searchName" class="form-label">{{__('Search name')}}</label>
                                <input id="searchName"
                                       class="form-control me-2"
                                       type="search"
                                       name="name"
                                       placeholder="name"
                                       aria-label="Name"
                                       value="{{ old('name') }}">
                            </div>

                            @if($sortable)
                                @include('helper.sortable')
                            @endif
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-outline-success" type="submit">Filter</button>
                            @if (\Request::is('admin/users/search'))
                                <a href="{{ route('users.index') }}" class="btn btn-outline-dark">Clear</a>
                            @endif
                        </div>
                    </form>

                </div>
                <div class="card">
                    <div class="card-body">
                        @if($users->count() === 0)
                            @include('helper.empty_data')
                        @else
                            @include('admin.user.list')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
