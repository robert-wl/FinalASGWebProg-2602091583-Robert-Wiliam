<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Message;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    private Message $messages;
    private Friend $friends;

    public function __construct(Message $messages, Friend $friends)
    {
        $this->messages = $messages;
        $this->friends = $friends;
    }

    public function message(): View|Factory|Application|RedirectResponse
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }
        $friends = $user->allFriends();

        return view('pages.messages', [
            'messages' => $this->messages->where('receiver_id', $user->id)->get(),
            'friends' => $friends,
        ]);
    }

    public function message_someone(string $id): Factory|Application|View|RedirectResponse
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $friend = $this->friends->where('friend_id', $id)
            ->where('user_id', $user->id)
            ->orWhere('friend_id', $user->id)
            ->where('user_id', $id)
            ->where('status', 'accepted')
            ->first();


        if (!$friend) {
            return redirect()->route('messages');
        }
        
        return view('pages.messages', [
            'messages' => $this->messages->where('receiver_id', $user->id)
                ->where('sender_id', $id)
                ->orWhere('receiver_id', $id)
                ->where('sender_id', $user->id)
                ->get(),
            'friends' => $user->allFriends(),
            'friend' => $friend,
        ]);
    }

    public function send(Request $request): RedirectResponse
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        $user = auth()->user();

        $this->messages->create([
            'sender_id' => $user->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return redirect()->route('message.person', $request->receiver_id)->with('success', 'Message sent.');
    }
}
