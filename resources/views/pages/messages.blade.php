@extends('layouts.app')

@section('content')
    <x-navbar/>
    <div class="container">
        <h1 class="my-4">Chat</h1>

        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Friends</h5>
                    </div>
                    <div class="card-body">
                        @if($friends->isEmpty())
                            <p class="text-muted">No friends yet.</p>
                        @else
                            <ul class="list-group">
                                @foreach($friends as $friend)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('message.person', $friend->id) }}"
                                           class="text-decoration-none">
                                            {{ $friend->name }}
                                        </a>
                                        @if($friend->unread_messages > 0)
                                            <span class="badge bg-danger">{{ $friend->unread_messages }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                @if(isset($friend) && $friend != null)
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Chat with {{ $friend->name }}</h5>
                        </div>
                        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                            @foreach($messages as $message)
                                <div class="mb-3">
                                    <div class="{{ $message->sender_id == Auth::id() ? 'text-end' : 'text-start' }}">
                                        <strong>{{ $message->sender->name }}:</strong>
                                        <p class="mb-1">{{ $message->message }}</p>
                                        <small
                                            class="text-muted">{{ $message->created_at->format('h:i A, M d') }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <form action="{{ route('messages.send') }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $friend->id }}">
                        <div class="input-group mb-3">
                        <textarea name="message" class="form-control" placeholder="Type your message..."
                                  required></textarea>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                @else
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">No friend selected</h5>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
