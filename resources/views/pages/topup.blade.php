@extends('layouts.app')

@section('content')
    <x-navbar/>
    <div class="container">
        <h1 class="my-4">Coin Topup</h1>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Your Current Coin Balance</h5>
                <p class="card-text display-4">{{ auth()->user()->coins }} coins</p>
            </div>
        </div>

        <form action="{{ route('coin.add') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary btn-lg">
                Add 100 Coins
            </button>
        </form>
    </div>
@endsection
