<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class PaymentController extends Controller
{

 
    public function payment(): View|Factory|Application
    {
        return view('payment');
    }
}
