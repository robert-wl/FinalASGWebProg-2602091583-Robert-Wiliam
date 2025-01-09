<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;


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

        $outgoingRequests = $this->wishlist->where('user_id', $user->id)
            ->with('wishedUser')
            ->get();

        $incomingRequests = $this->wishlist->where('wished_user_id', $user->id)
            ->with('user')
            ->get();

        return view('wishlist.index', [
            'outgoingRequests' => $outgoingRequests,
            'incomingRequests' => $incomingRequests,
        ]);
    }
}
