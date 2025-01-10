@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4 fw-bold text-primary">@lang('login.login')</h2>

                        <form method="POST" action="{{ route('login_user') }}" class="needs-validation" novalidate>
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label fw-medium">
                                    @lang('login.email')
                                </label>
                                <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-envelope text-muted"></i>
                                </span>
                                    <input type="email"
                                           id="email"
                                           name="email"
                                           class="form-control form-control-lg border-start-0 shadow-none ps-0"
                                           required
                                           autofocus
                                           placeholder="name@example.com">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-medium">
                                    @lang('login.password')
                                </label>
                                <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-lock text-muted"></i>
                                </span>
                                    <input type="password"
                                           id="password"
                                           name="password"
                                           class="form-control form-control-lg border-start-0 shadow-none ps-0"
                                           required
                                           placeholder="••••••••">
                                </div>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    @lang('login.submit')
                                </button>
                            </div>

                            <div class="text-center mt-4">
                                <a href="{{ route('register') }}" class="text-decoration-none">
                                    @lang('login.no_account')
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-4 text-muted">
                    <small>
                        &copy; {{ date('Y') }} ConnectFriend. @lang('login.rights_reserved')
                    </small>
                </div>
            </div>
        </div>
    </div>

    <style>
        .input-group-text {
            border-radius: 0.5rem 0 0 0.5rem;
        }

        .input-group .form-control {
            border-radius: 0 0.5rem 0.5rem 0;
        }

        .form-control:focus {
            border-color: #86b7fe;
        }

        .input-group:focus-within .input-group-text {
            border-color: #86b7fe;
        }
    </style>
@endsection
