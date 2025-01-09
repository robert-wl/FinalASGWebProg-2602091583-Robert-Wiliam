@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h2 class="text-center mb-0">Payment Page</h2>
                    </div>
                    <div class="card-body">
                        <h4 class="mb-4">Registration Fee:
                            <strong>Rp {{ number_format($registration_fee, 0, ',', '.') }}</strong></h4>

                        @if (session('message'))
                            <div class="alert alert-info">
                                {{ session('message') }}
                            </div>
                        @endif

                        @if(!session('overpaid'))
                            <form action="{{ route('payment.process') }}" method="POST" class="needs-validation"
                                  novalidate>
                                @csrf

                                <div class="mb-4">
                                    <label for="amount" class="form-label fw-bold">Payment Amount</label>
                                    <input type="number" id="amount" name="amount"
                                           class="form-control @error('amount') is-invalid @enderror"
                                           value="{{ old('amount') }}" required>
                                    @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Enter the amount you want to pay in Indonesian Rupiah.
                                    </small>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-success btn-lg">Make Payment</button>
                                </div>
                            </form>
                        @endif

                        @if(session('overpaid'))
                            <form action="{{ route('payment.overpay') }}" method="POST" class="mt-4">
                                @csrf
                                <input type="hidden" name="overpaid_amount" value="{{ session('overpaid') }}">

                                <h5>You overpaid Rp {{ number_format(session('overpaid'), 0, ',', '.') }}.</h5>
                                <p>Would you like to:</p>

                                <div class="d-grid gap-2">
                                    <button type="submit" name="action" value="wallet" class="btn btn-primary">
                                        Add to Wallet
                                    </button>
                                    <button type="submit" name="action" value="reenter" class="btn btn-warning">
                                        Re-enter Amount
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
