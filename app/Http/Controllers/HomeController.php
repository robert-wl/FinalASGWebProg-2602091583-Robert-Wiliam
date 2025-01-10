<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function home(): View|Factory|Application
    {
        $current_user = auth()->user();


        if (!$current_user) {
            $users = $this->user->paginate(10);
            return view('pages.home', [
                'users' => $users,
            ]);
        }
        $users = $this->user->where('id', '!=', $current_user->id)
            ->where('visibility', true)
            ->paginate(10);
        return view('pages.home', [
            'users' => $users,
        ]);
    }

    public function filter(Request $request): View|Factory|Application
    {
        $request->validate([
            'gender' => 'required|in:Male,Female',
        ]);

        $users = $this->user->where('gender', $request->gender)
            ->where('visibility', true)
            ->paginate(10);

        return view('pages.home', [
            'users' => $users,
        ]);
    }

    public function search(Request $request): View|Factory|Application
    {
        $request->validate([
            'search' => 'required|string|max:255',
        ]);

        $users = $this->user->where('summary', 'like', '%' . $request->search . '%')
            ->where('visibility', true)
            ->paginate(10);

        return view('pages.home', [
            'users' => $users,
        ]);
    }
}
