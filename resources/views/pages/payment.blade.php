@extends('app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Payment Page</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('payment.process') }}" method="POST">
                            @csrf

                            <p><strong>Registration Fee:</strong> {{ session('registration_price', 100000) }} coins</p>

                            <!-- Payment Amount -->
                            <div class="mb-3">
                                <label for="payment_amount" class="form-label">Enter Payment Amount</label>
                                <input type="number" id="payment_amount" name="payment_amount" class="form-control"
                                       required>
                            </div>

                            <!-- Validation Messages -->
                            @if(session('message'))
                                <div class="alert alert-info">
                                    {{ session('message') }}
                                </div>
                            @endif

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Pay</button>
                            </div>
                        </form>

                        <!-- Handle Overpaid -->
                        @if(session('overpaid_amount'))
                            <div class="mt-4">
                                <p>You overpaid by <strong>{{ session('overpaid_amount') }} coins</strong>.</p>
                                <p>Would you like to enter the balance into your wallet?</p>
                                <form action="{{ route('payment.overpaid') }}" method="POST">
                                    @csrf
                                    <button type="submit" name="add_to_wallet" value="yes" class="btn btn-success">Yes
                                    </button>
                                    <button type="submit" name="add_to_wallet" value="no" class="btn btn-danger">No
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
