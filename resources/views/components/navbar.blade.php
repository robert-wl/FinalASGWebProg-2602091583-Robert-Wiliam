<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">ConnectFriend</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('wishlist') ? 'active' : '' }}"
                       href="{{ route('friends') }}">Friends</a>
                </li>

                <!-- Profile Link -->
                {{--                <li class="nav-item">--}}
                {{--                    <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}"--}}
                {{--                       href="{{ route('profile') }}">Profile</a>--}}
                {{--                </li>--}}

                <!-- Chat Link -->
                {{--                <li class="nav-item">--}}
                {{--                    <a class="nav-link {{ request()->routeIs('chat') ? 'active' : '' }}"--}}
                {{--                       href="{{ route('chat') }}">Chat</a>--}}
                {{--                </li>--}}

                <!-- Avatar Store Link -->
                {{--                <li class="nav-item">--}}
                {{--                    <a class="nav-link {{ request()->routeIs('avatar.store') ? 'active' : '' }}"--}}
                {{--                       href="{{ route('avatar.store') }}">Avatar Store</a>--}}
                {{--                </li>--}}

                <!-- Coin Topup Link -->
                {{--                <li class="nav-item">--}}
                {{--                    <a class="nav-link {{ request()->routeIs('coin.topup') ? 'active' : '' }}"--}}
                {{--                       href="{{ route('coin.topup') }}">Topup Coins</a>--}}
                {{--                </li>--}}
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            {{--                            <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>--}}
                            {{--                            <li><a class="dropdown-item" href="{{ route('wishlist') }}">Wishlist</a></li>--}}
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}"
                           href="{{ route('login') }}">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
