@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-success text-white py-3">
                        <h2 class="text-center mb-0 fw-bold">
                            <i class="fas fa-credit-card me-2"></i>
                            @lang('payment.payment_page')
                        </h2>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h4 class="fw-bold text-success mb-2">@lang('payment.registration_fee')</h4>
                            <div class="h3 fw-bold">
                                Rp {{ number_format($registration_fee, 0, ',', '.') }}
                            </div>
                        </div>

                        @if (session('message'))
                            <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert">
                                <i class="fas fa-info-circle me-2"></i>
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif

                        @if(!session('overpaid'))
                            <form action="{{ route('payment.process') }}" method="POST" class="needs-validation"
                                  novalidate>
                                @csrf
                                <div class="mb-4">
                                    <label for="amount" class="form-label fw-bold text-success">
                                        <i class="fas fa-money-bill-wave me-2"></i>
                                        @lang('payment.payment_amount')
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">Rp</span>
                                        <input type="number" id="amount" name="amount"
                                               class="form-control form-control-lg @error('amount') is-invalid @enderror"
                                               value="{{ old('amount') }}"
                                               placeholder="0"
                                               required>
                                    </div>
                                    @error('amount')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <small class="form-text text-muted mt-2">
                                        <i class="fas fa-info-circle me-1"></i>
                                        @lang('payment.enter_amount_hint')
                                    </small>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-success btn-lg fw-bold shadow-sm">
                                        <i class="fas fa-check-circle me-2"></i>
                                        @lang('payment.make_payment')
                                    </button>
                                </div>
                            </form>
                        @endif

                        @if(session('overpaid'))
                            <div class="card bg-light border-0 shadow-sm mb-4">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-exclamation-circle text-warning display-5 mb-3"></i>
                                    <h5 class="fw-bold">
                                        @lang('payment.overpaid_message', ['amount' => number_format(session('overpaid'), 0, ',', '.')])
                                    </h5>
                                    <p class="text-muted">@lang('payment.overpaid_options')</p>
                                </div>
                            </div>

                            <form action="{{ route('payment.overpay') }}" method="POST">
                                @csrf
                                <input type="hidden" name="overpaid_amount" value="{{ session('overpaid') }}">
                                <div class="d-grid gap-3">
                                    <button type="submit" name="action" value="wallet"
                                            class="btn btn-primary btn-lg fw-bold shadow-sm">
                                        <i class="fas fa-wallet me-2"></i>
                                        @lang('payment.add_to_wallet')
                                    </button>
                                    <button type="submit" name="action" value="reenter"
                                            class="btn btn-warning btn-lg fw-bold shadow-sm">
                                        <i class="fas fa-edit me-2"></i>
                                        @lang('payment.reenter_amount')
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
