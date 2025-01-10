@extends('layouts.app')

@section('content')
    <x-navbar/>
    <div class="container">
        <h1 class="my-4">Friends</h1>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Incoming Friend Requests</h5>
            </div>
            <div class="card-body">
                @if($incomingRequests->isEmpty())
                    <p class="text-muted">No incoming friend requests.</p>
                @else
                    <div class="row">
                        @foreach($incomingRequests as $request)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <img src="{{ $request->user->avatar }}" class="card-img-top"
                                         alt="{{ $request->user->name }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $request->user->name }}</h5>
                                        <p class="card-text text-muted">Sent you a friend request.</p>
                                        <div class="d-flex gap-2">
                                            <form action="{{ route('friends.accept', $request->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                            </form>
                                            <form action="{{ route('friends.reject', $request->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
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

        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Accepted Friends</h5>
            </div>
            <div class="card-body">
                @if($acceptedFriends->isEmpty())
                    <p class="text-muted">No accepted friends yet.</p>
                @else
                    <div class="row">
                        @foreach($acceptedFriends as $friend)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <img src="{{ $friend->avatar }}" class="card-img-top" alt="{{ $friend->name }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $friend->name }}</h5>
                                        <p class="card-text text-muted">You are friends.</p>
                                        <form action="{{ route('friends.remove', $friend->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Remove Friend</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
