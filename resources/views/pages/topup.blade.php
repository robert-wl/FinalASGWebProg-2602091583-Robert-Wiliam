@extends('layouts.app')
@section('content')
    <x-navbar/>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold text-center mb-5 text-primary">
                    <i class="bi bi-coin me-3"></i>@lang('topup.coin_topup')
                </h1>

                <div class="card border-0 shadow-lg mb-5">
                    <div class="card-body p-5 text-center">
                        <div class="mb-4">
                            <span class="badge bg-primary-subtle text-primary px-4 py-2 fs-6 rounded-pill">
                                @lang('topup.current_coin_balance')
                            </span>
                        </div>

                        <div class="d-flex align-items-center justify-content-center gap-3 mb-4">
                            <i class="bi bi-coin text-warning display-1"></i>
                            <p class="display-1 fw-bold text-primary mb-0">{{ auth()->user()->coins }}</p>
                        </div>

                        <p class="text-muted mb-0">@lang('topup.coins_in_your_account')</p>
                    </div>
                </div>

                <div class="card border-0 shadow bg-gradient text-white" style="background-color: #4361ee;">
                    <div class="card-body p-5 text-center">
                        <h3 class="mb-4">@lang('topup.ready_to_add_more')</h3>

                        <form action="{{ route('coin.add') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-lg btn-light px-5 py-3 shadow-sm">
                                <i class="bi bi-plus-circle-fill me-2"></i>
                                @lang('topup.add_coins')
                            </button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 1rem;
            overflow: hidden;
        }

        .btn {
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .badge {
            font-weight: 500;
        }

        .bg-primary-subtle {
            background-color: rgba(67, 97, 238, 0.1);
        }

        .text-primary {
            color: #4361ee !important;
        }

        .display-1 {
            font-size: 4.5rem;
        }

        .display-5 {
            font-size: 2.5rem;
        }
    </style>
@endsection
