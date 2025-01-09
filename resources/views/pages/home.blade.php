@extends('layouts.app') <!-- Assuming a layout file exists -->

@section('content')
    <div class="container">
        <h1 class="text-center my-4">
            Welcome to ConnectFriend
        </h1>

        <div class="row mb-4">
            <div class="col-md-6">
                <h3>Filter by Gender</h3>
                <form action="{{ route('home.filter') }}" method="GET" class="d-flex">
                    <select name="gender" class="form-select me-2" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
            <div class="col-md-6">
                <form action="{{ route('home.search') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2"
                           placeholder="Enter field of work" required>
                    <button type="submit" class="btn btn-success">Search</button>
                </form>
            </div>
        </div>

        <div class="row">
            <h3 class="mb-3">Users List</h3>
            @forelse($users as $user)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $user->avatar }}" class="card-img-top" alt="{{ $user->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            @auth
                                <form action="{{ route('wishlist.add') }}" method="POST" class="mt-2">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <button type="submit" class="btn btn-success">Thumb</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">No users found. Try adjusting the filters or searching.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
