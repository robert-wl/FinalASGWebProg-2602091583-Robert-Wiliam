<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function payment(): View|Factory|Application
    {
        $registration_fee = $this->user->find(auth()->id())->registration_fee;
        return view('pages.payment', [
            'registration_fee' => $registration_fee,
        ]);
    }

    public function process_payment(Request $request): RedirectResponse
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $currentUser = $this->user->find(auth()->id());
        $registrationFee = $currentUser->registration_fee;
        $amountPaid = $request->input('amount');
        $balance = $amountPaid - $registrationFee;

        if ($amountPaid < $registrationFee) {
            $underpaid = $registrationFee - $amountPaid;
            return back()->with('message', "You are still underpaid Rp " . number_format($underpaid, 0, ',', '.'));
        }

        if ($amountPaid > $registrationFee) {
            $overpaid = $balance;
            return back()->with([
                'message' => "You overpaid Rp " . number_format($overpaid, 0, ',', '.'),
                'overpaid' => $overpaid,
            ]);
        }

        return redirect()->route('home')->with('message', 'Payment successful! Welcome to ConnectFriend!');
    }

    public function handle_overpayment(Request $request): RedirectResponse
    {
        $request->validate([
            'action' => 'required|string',
            'overpaid_amount' => 'required|numeric|min:1',
        ]);

        $currentUser = $this->user->find(auth()->id());
        $action = $request->input('action');
        $overpaidAmount = $request->input('overpaid_amount');

        if ($action === 'wallet') {
            $currentUser->coins += $overpaidAmount;
            $currentUser->registration_fee = null;
            $currentUser->save();

            return redirect()->route('home')->with('message', 'Overpaid amount added to your wallet successfully!');
        }

        if ($action === 'reenter') {
            return redirect()->route('payment')->with('message', 'Please re-enter your payment amount.');
        }

        return back()->with('message', 'Invalid action.');
    }
}
