@extends('layouts.app')
@section('content')
    <x-navbar/>
    <div class="container py-5">
        <h1 class="display-5 fw-bold text-primary mb-4">@lang('friend.friends')</h1>

        <!-- Incoming Requests Section -->
        <div class="card border-0 shadow-sm mb-5">
            <div class="card-header bg-gradient p-4" style="background-color: #4361ee;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-person-plus-fill text-white fs-4 me-2"></i>
                    <h3 class="mb-0 text-white">@lang('friend.incoming_requests')</h3>
                </div>
            </div>
            <div class="card-body p-4">
                @if($incomingRequests->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-inbox text-muted fs-1"></i>
                        <p class="text-muted mt-3 mb-0">@lang('friend.no_incoming_requests')</p>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach($incomingRequests as $request)
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                                    <img src="{{ $request->user->avatar }}"
                                         class="card-img-top object-fit-cover"
                                         style="height: 200px;"
                                         alt="{{ $request->user->name }}">
                                    <div class="card-body p-4">
                                        <h5 class="card-title fw-bold mb-3">{{ $request->user->name }}</h5>
                                        <p class="card-text text-muted mb-4">
                                            <i class="bi bi-clock-history me-2"></i>
                                            @lang('friend.sent_you_request')
                                        </p>
                                        <div class="d-flex gap-2">
                                            <form action="{{ route('friends.accept', $request->id) }}" method="POST"
                                                  class="flex-grow-1">
                                                @csrf
                                                <button type="submit" class="btn btn-success w-100">
                                                    <i class="bi bi-check-lg me-2"></i>
                                                    @lang('friend.accept')
                                                </button>
                                            </form>
                                            <form action="{{ route('friends.reject', $request->id) }}" method="POST"
                                                  class="flex-grow-1">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger w-100">
                                                    <i class="bi bi-x-lg me-2"></i>
                                                    @lang('friend.reject')
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Accepted Friends Section -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-gradient p-4" style="background-color: #2ea44f;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-people-fill text-white fs-4 me-2"></i>
                    <h3 class="mb-0 text-white">@lang('friend.accepted_friends')</h3>
                </div>
            </div>
            <div class="card-body p-4">
                @if($acceptedFriends->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-people text-muted fs-1"></i>
                        <p class="text-muted mt-3 mb-0">@lang('friend.no_accepted_friends')</p>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach($acceptedFriends as $friend)
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                                    <img src="{{ $friend->avatar }}"
                                         class="card-img-top object-fit-cover"
                                         style="height: 200px;"
                                         alt="{{ $friend->name }}">
                                    <div class="card-body p-4">
                                        <h5 class="card-title fw-bold mb-3">{{ $friend->name }}</h5>
                                        <p class="card-text text-success mb-4">
                                            <i class="bi bi-check-circle-fill me-2"></i>
                                            @lang('friend.you_are_friends')
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="{{ route('messages.show', $friend->id) }}"
                                               class="btn btn-outline-primary">
                                                <i class="bi bi-chat-dots me-2"></i>
                                                @lang('friend.message')
                                            </a>
                                            <form action="{{ route('friends.remove', $friend->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger">
                                                    <i class="bi bi-person-x me-2"></i>
                                                    @lang('friend.remove_friend')
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .hover-shadow {
            transition: all 0.3s ease;
        }

        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .card {
            border-radius: 1rem;
            overflow: hidden;
        }

        .card-header {
            border-bottom: none;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
        }
    </style>
@endsection
