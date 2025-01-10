<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register(): View|Factory|Application
    {
        $registration_fee = rand(100000, 125000);
        return view('pages.register', [
            'registration_fee' => $registration_fee,
        ]);
    }

    public function create_user(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/'
            ],
            'gender' => ['required', 'in:Male,Female'],
            'fields' => ['required', 'array', 'min:3'],
            'linkedin' => ['required', 'string', 'regex:/^[a-zA-Z0-9-]+$/'],
            'mobile' => ['required', 'string', 'regex:/^[0-9]+$/'],
            'summary' => ['required', 'string', 'min:10'],
            'registration_fee' => ['required', 'numeric'],
        ], [
            'password.regex' => 'Password must contain at least one letter, one number, and one special character.',
            'fields.min' => 'Please select at least 3 fields of interest.',
            'linkedin.regex' => 'LinkedIn username can only contain letters, numbers, and hyphens.',
            'mobile.regex' => 'Mobile number must contain only digits.',
            'summary.min' => 'Professional summary must be at least 100 characters long.',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'fields' => implode(',', $request->fields),
            'linkedin' => $request->linkedin,
            'mobile' => $request->mobile,
            'summary' => $request->summary,
            'registration_fee' => $request->registration_fee,
        ]);

        auth()->login($user);

        return redirect()->route('payment.process')
            ->with('success', 'Account created successfully! Welcome to Job Friends.');
    }

    public function login(): View|Factory|Application
    {
        return view('pages.login');
    }

    public function login_user(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials is incorrect.',
        ])->withInput($request->only('email'));
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function toggle_visibility(Request $request): RedirectResponse
    {
        $user = auth()->user();

        if ($user->visibility) {
            $user->visibility = false;
            $user->coins -= 50;
        } else {
            $user->visibility = true;
            $user->coins -= 5;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile visibility updated successfully.');
    }
}
