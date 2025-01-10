@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-gradient text-white p-4" style="background-color: #4361ee;">
                        <h2 class="text-center mb-0 fw-bold">@lang('register.title')</h2>
                        <p class="text-center mb-0 mt-2 text-white-50">@lang('register.subtitle')</p>
                    </div>

                    <div class="card-body p-4 p-lg-5">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('create_user') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

                            <!-- Personal Information Section -->
                            <div class="mb-5">
                                <h4 class="mb-4 text-primary">@lang('register.personal_info')</h4>

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">@lang('register.full_name')</label>
                                        <input type="text" id="name" name="name"
                                               class="form-control form-control-lg @error('name') is-invalid @enderror"
                                               value="{{ old('name') }}" required
                                               placeholder="John Doe">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email" class="form-label">@lang('register.email_address')</label>
                                        <input type="email" id="email" name="email"
                                               class="form-control form-control-lg @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" required
                                               placeholder="you@example.com">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password" class="form-label">@lang('register.password')</label>
                                        <div class="input-group input-group-lg">
                                            <input type="password" id="password" name="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   required>
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        <small class="form-text text-muted mt-2">
                                            @lang('register.password_hint')
                                        </small>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="gender" class="form-label">@lang('register.gender')</label>
                                        <select id="gender" name="gender"
                                                class="form-select form-select-lg @error('gender') is-invalid @enderror"
                                                required>
                                            <option value="">@lang('register.select_gender')</option>
                                            <option
                                                value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>@lang('register.male')</option>
                                            <option
                                                value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>@lang('register.female')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Professional Information Section -->
                            <div class="mb-5">
                                <h4 class="mb-4 text-primary">@lang('register.professional_info')</h4>

                                <div class="mb-4">
                                    <label class="form-label">@lang('register.fields_of_interest')</label>
                                    <div class="row g-3">
                                        @foreach(['Technology', 'Finance', 'Healthcare', 'Education', 'Marketing', 'Design', 'Engineering', 'Sales'] as $field)
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-check custom-checkbox">
                                                    <input class="form-check-input" type="checkbox"
                                                           name="fields[]" value="{{ $field }}"
                                                           id="field_{{ $loop->index }}"
                                                        {{ in_array($field, old('fields', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="field_{{ $loop->index }}">
                                                        {{ $field }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <small class="form-text text-muted mt-2">
                                        @lang('register.fields_hint')
                                    </small>
                                </div>

                                <div class="mb-4">
                                    <label for="linkedin" class="form-label">@lang('register.linkedin_username')</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light">linkedin.com/in/</span>
                                        <input type="text" id="linkedin" name="linkedin"
                                               class="form-control @error('linkedin') is-invalid @enderror"
                                               value="{{ old('linkedin') }}" required
                                               placeholder="username">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="mobile" class="form-label">@lang('register.mobile_number')</label>
                                    <input type="text" id="mobile" name="mobile"
                                           class="form-control form-control-lg @error('mobile') is-invalid @enderror"
                                           value="{{ old('mobile') }}" required
                                           placeholder="+62 xxx-xxxx-xxxx">
                                </div>

                                <div class="mb-4">
                                    <label for="summary"
                                           class="form-label">@lang('register.professional_summary')</label>
                                    <textarea id="summary" name="summary"
                                              class="form-control form-control-lg @error('summary') is-invalid @enderror"
                                              rows="4" required
                                              placeholder="Tell us about your professional background...">{{ old('summary') }}</textarea>
                                    <small class="form-text text-muted mt-2">
                                        @lang('register.summary_hint')
                                    </small>
                                </div>
                            </div>

                            <!-- Registration Fee Section -->
                            <div class="mb-5">
                                <div class="card bg-light border-0">
                                    <div class="card-body p-4">
                                        <h4 class="card-title mb-3">@lang('register.registration_fee')</h4>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-white">Rp</span>
                                            <input type="text" class="form-control bg-white"
                                                   name="registration_fee"
                                                   value="{{ $registration_fee }}"
                                                   readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg py-3">
                                    @lang('register.create_account')
                                </button>
                            </div>

                            <p class="text-center mt-4">
                                @lang('register.already_have_account')
                                <a href="{{ route('login') }}"
                                   class="text-decoration-none">@lang('register.login_here')</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #4361ee;
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        }

        .custom-checkbox .form-check-input:checked {
            background-color: #4361ee;
            border-color: #4361ee;
        }

        .input-group-text {
            border: 1px solid #ced4da;
        }

        .card {
            border-radius: 1rem;
        }

        .card-header {
            border-radius: 1rem 1rem 0 0;
        }
    </style>
@endsection
