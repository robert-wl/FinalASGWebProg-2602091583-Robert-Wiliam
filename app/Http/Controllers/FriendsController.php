<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class FriendsController extends Controller
{
    private User $user;
    private Wishlist $wishlist;

    public function __construct(User $user, Wishlist $wishlist)
    {
        $this->user = $user;
        $this->wishlist = $wishlist;
    }

    public function index(): Factory|View|Application|RedirectResponse
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $acceptedFriends = $user->friends()->where('status', 'accepted')->get();

        $incomingRequests = $this->wishlist->where('wished_user_id', $user->id)
            ->with('user')
            ->get();

        return view('pages.friends', [
            'acceptedFriends' => $acceptedFriends,
            'incomingRequests' => $incomingRequests,
        ]);
    }

    public function add_friend(Request $request): RedirectResponse
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $this->wishlist->create([
            'user_id' => $user->id,
            'wished_user_id' => $request->user_id,
        ]);

        return redirect()->route('friends');

    }
}
