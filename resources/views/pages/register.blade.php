@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="text-center mb-0">Find Your Job Friends</h2>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('create_user') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold">Full Name</label>
                                <input type="text" id="name" name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold">Email Address</label>
                                <input type="email" id="email" name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <input type="password" id="password" name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Must be at least 8 characters long and contain letters, numbers, and symbols
                                </small>
                            </div>

                            <div class="mb-4">
                                <label for="gender" class="form-label fw-bold">Gender</label>
                                <select id="gender" name="gender"
                                        class="form-select @error('gender') is-invalid @enderror"
                                        required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                                @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Fields of Interest</label>
                                <div class="row">
                                    @foreach(['Technology', 'Finance', 'Healthcare', 'Education', 'Marketing', 'Design', 'Engineering', 'Sales'] as $field)
                                        <div class="col-md-6">
                                            <div class="form-check mb-2">
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
                                @error('fields')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Select at least 3 fields that interest you
                                </small>
                            </div>

                            <div class="mb-4">
                                <label for="linkedin" class="form-label fw-bold">LinkedIn Username</label>
                                <div class="input-group">
                                    <span class="input-group-text">linkedin.com/in/</span>
                                    <input type="text" id="linkedin" name="linkedin"
                                           class="form-control @error('linkedin') is-invalid @enderror"
                                           value="{{ old('linkedin') }}" required>
                                    @error('linkedin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="mobile" class="form-label fw-bold">Mobile Number</label>
                                <input type="text" id="mobile" name="mobile"
                                       class="form-control @error('mobile') is-invalid @enderror"
                                       value="{{ old('mobile') }}" required>
                                @error('mobile')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="summary" class="form-label fw-bold">Professional Summary</label>
                                <textarea id="summary" name="summary"
                                          class="form-control @error('summary') is-invalid @enderror"
                                          rows="4" required>{{ old('summary') }}</textarea>
                                @error('summary')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Tell us about your professional background and what you're looking for in job
                                    connections
                                </small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Registration Fee</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control"
                                           name="registration_fee"
                                           value="{{ $registration_fee }}"
                                           readonly>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Create Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
