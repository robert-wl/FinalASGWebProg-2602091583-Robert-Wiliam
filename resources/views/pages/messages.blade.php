@extends('layouts.app')

@section('content')
    <x-navbar/>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0 text-center">@lang('message.friends')</h4>
                    </div>
                    <div class="card-body p-0">
                        @if($friends->isEmpty())
                            <p class="text-muted p-3 mb-0">@lang('message.no_friends')</p>
                        @else
                            <ul class="list-group list-group-flush">
                                @foreach($friends as $friend)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('message.person', $friend->id) }}"
                                           class="text-decoration-none text-dark fw-medium">
                                            {{ $friend->name }}
                                        </a>
                                        @if($friend->unread_messages > 0)
                                            <span class="badge rounded-pill bg-danger">
                                                {{ $friend->unread_messages }}
                                            </span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                @if(isset($friend) && $friend != null)
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h4 class="mb-0 text-center">
                                @lang('message.chat_with', ['name' => $friend->name])
                            </h4>
                        </div>
                        <div class="card-body chat-container"
                             style="height: 400px; overflow-y: auto; background-color: #f8f9fa;">
                            @foreach($messages as $message)
                                <div class="mb-3">
                                    @if($message->sender_id == Auth::id())
                                        <div class="d-flex justify-content-end">
                                            <div
                                                class="message-bubble sent p-3 bg-success text-white rounded-3 shadow-sm"
                                                style="max-width: 75%;">
                                                <p class="mb-1">{{ $message->message }}</p>
                                                <small
                                                    class="opacity-75">{{ $message->created_at->format('h:i A, M d') }}</small>
                                            </div>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-start">
                                            <div class="message-bubble received p-3 bg-white rounded-3 shadow-sm"
                                                 style="max-width: 75%;">
                                                <small class="text-success fw-bold">{{ $message->sender->name }}</small>
                                                <p class="mb-1">{{ $message->message }}</p>
                                                <small
                                                    class="text-muted">{{ $message->created_at->format('h:i A, M d') }}</small>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer bg-light">
                            <form action="{{ route('messages.send') }}" method="POST" class="mb-0">
                                @csrf
                                <input type="hidden" name="receiver_id" value="{{ $friend->id }}">
                                <div class="input-group">
                                    <textarea name="message"
                                              class="form-control border-2"
                                              placeholder="@lang('message.type_your_message')"
                                              rows="2"
                                              required></textarea>
                                    <button type="submit" class="btn btn-success px-4">
                                        @lang('message.send')
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h4 class="mb-0 text-center">@lang('message.no_friend_selected')</h4>
                        </div>
                        <div class="card-body text-center py-5">
                            <p class="text-muted mb-0">Select a friend from the list to start chatting</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
