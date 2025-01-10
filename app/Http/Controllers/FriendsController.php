<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class FriendsController extends Controller
{
    private User $users;
    private Friend $friends;

    public function __construct(User $user, Friend $friend)
    {
        $this->users = $user;
        $this->friends = $friend;
    }

    public function index(): Factory|View|Application|RedirectResponse
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }


        $incomingRequests = $this->friends->where('friend_id', $user->id)
            ->where('status', 'pending')
            ->with('user')
            ->get();

        return view('pages.friends', [
            'acceptedFriends' => $user->allFriends(),
            'incomingRequests' => $incomingRequests,
        ]);
    }

    public function add_friend(Request $request): RedirectResponse
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $this->friends->create([
            'user_id' => $user->id,
            'friend_id' => $request->user_id,
            'status' => 'pending',
        ]);

        return redirect()->route('home');
    }

    public function accept_friend(string $id): RedirectResponse
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $this->friends->where('id', $id)
            ->update(['status' => 'accepted']);


        return redirect()->route('friends');
    }

    public function reject_friend(string $id): RedirectResponse
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $this->friends->where('id', $id)
            ->update(['status' => 'rejected']);

        return redirect()->route('friends');
    }

    public function remove_friend(string $id): RedirectResponse
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $this->friends->where('friend_id', $id)
            ->where('user_id', $user->id)
            ->delete();

        $this->friends->where('user_id', $id)
            ->where('friend_id', $user->id)
            ->delete();

        return redirect()->route('friends');
    }
}
