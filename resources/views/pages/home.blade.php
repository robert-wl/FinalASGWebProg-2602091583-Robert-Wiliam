@extends('layouts.app')

@section('content')
    <x-navbar/>
    <div class="container py-5">
        <h1 class="text-center mb-5 fw-bold display-4">
            @lang('home.welcome')
        </h1>

        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 bg-light">
                    <div class="card-body p-4">
                        <h3 class="h4 mb-4 text-primary">@lang('home.filter_by_gender')</h3>
                        <form action="{{ route('home.filter') }}" method="GET" class="d-flex gap-3">
                            <select name="gender" class="form-select form-select-lg shadow-none" required>
                                <option value="">@lang('home.select_gender')</option>
                                <option value="Male">@lang('home.male')</option>
                                <option value="Female">@lang('home.female')</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-lg px-4">
                                @lang('home.filter')
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm border-0 bg-light">
                    <div class="card-body p-4">
                        <h3 class="h4 mb-4 text-success">@lang('home.search')</h3>
                        <form action="{{ route('home.search') }}" method="GET" class="d-flex gap-3">
                            <input type="text" name="search" class="form-control form-control-lg shadow-none"
                                   placeholder="@lang('home.enter_field_of_work')" required>
                            <button type="submit" class="btn btn-success btn-lg px-4">
                                @lang('home.search')
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="h2 mb-4 fw-bold text-primary">@lang('home.users_list')</h3>
            </div>

            @forelse($users as $user)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 hover-shadow-lg transition-all">
                        <img src="{{ $user->avatar }}" class="card-img-top object-fit-cover" style="height: 200px;"
                             alt="{{ $user->name }}">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3">{{ $user->name }}</h5>

                            <div class="mb-3">
                                <div class="text-muted small mb-2">@lang('home.profession')</div>
                                <p class="fw-medium mb-0">{{ $user->summary }}</p>
                            </div>

                            <div class="mb-4">
                                <div class="text-muted small mb-2">@lang('home.interests')</div>
                                <p class="fw-medium mb-0">{{ $user->fields }}</p>
                            </div>

                            @auth
                                @if(!$user->is_friended())
                                    <form action="{{ route('friends.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-success w-100">
                                            @lang('home.thumb')
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center p-5">
                        <p class="mb-0">@lang('home.no_users_found')</p>
                    </div>
                </div>
            @endforelse

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <style>
        .hover-shadow-lg {
            transition: box-shadow 0.3s ease;
        }

        .hover-shadow-lg:hover {
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
        }

        .transition-all {
            transition: all 0.3s ease;
        }
    </style>
@endsection
