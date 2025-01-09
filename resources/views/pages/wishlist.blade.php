@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Wishlist</h1>

        <div class="card mb-4">
            <div class="card-header">
                <h3>Outgoing Requests</h3>
            </div>
            <div class="card-body">
                @if ($outgoingRequests->isEmpty())
                    <p class="text-muted">You have not sent any requests.</p>
                @else
                    <ul class="list-group">
                        @foreach ($outgoingRequests as $request)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <img src="{{ $request->wishedUser->avatar }}" alt="{{ $request->wishedUser->name }}"
                                         class="rounded-circle" width="50">
                                    <span class="ms-3">{{ $request->wishedUser->name }}</span>
                                </div>
                                <span class="badge bg-{{ $request->accepted_by_wished ? 'success' : 'warning' }}">
                                    {{ $request->accepted_by_wished ? 'Accepted' : 'Pending' }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h3>Incoming Requests</h3>
            </div>
            <div class="card-body">
                @if ($incomingRequests->isEmpty())
                    <p class="text-muted">You have no incoming requests.</p>
                @else
                    <ul class="list-group">
                        @foreach ($incomingRequests as $request)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <img src="{{ $request->user->avatar }}" alt="{{ $request->user->name }}"
                                         class="rounded-circle" width="50">
                                    <span class="ms-3">{{ $request->user->name }}</span>
                                </div>
                                <div>
                                    <form action="{{ route('wishlist.accept', $request->id) }}" method="POST"
                                          class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                    </form>
                                    <form action="{{ route('wishlist.reject', $request->id) }}" method="POST"
                                          class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
