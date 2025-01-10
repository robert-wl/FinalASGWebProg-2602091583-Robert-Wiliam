<nav class="navbar navbar-expand-lg navbar-dark bg-gradient" style="background-color: #2c3e50;">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="{{ route('home') }}">ConnectFriend</a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item mx-1">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }} px-3 rounded-pill"
                       href="{{ route('home') }}">
                        @lang('navbar.home')
                    </a>
                </li>

                <li class="nav-item mx-1">
                    <a class="nav-link {{ request()->routeIs('friends') ? 'active fw-bold' : '' }} px-3 rounded-pill"
                       href="{{ route('friends') }}">
                        @lang('navbar.friends')
                    </a>
                </li>

                <li class="nav-item mx-1">
                    <a class="nav-link {{ request()->routeIs('messages') ? 'active fw-bold' : '' }} px-3 rounded-pill"
                       href="{{ route('messages') }}">
                        @lang('navbar.messages')
                    </a>
                </li>

                <li class="nav-item mx-1">
                    <a class="nav-link {{ request()->routeIs('topup') ? 'active fw-bold' : '' }} px-3 rounded-pill"
                       href="{{ route('topup') }}">
                        @lang('navbar.topup')
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown mx-1">
                    <a class="nav-link dropdown-toggle px-3 rounded-pill" href="#" id="languageDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('navbar.language')
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2"
                        aria-labelledby="languageDropdown">
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('language.switch', 'en') }}">English</a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('language.switch', 'id') }}">Indonesia</a>
                        </li>
                    </ul>
                </li>

                @auth
                    <li class="nav-item dropdown mx-1">
                        <a class="nav-link dropdown-toggle px-3 rounded-pill" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2"
                            aria-labelledby="navbarDropdown">
                            <li class="px-3 py-2">
                                <strong>@lang('navbar.coins'):</strong>
                                <span class="badge bg-warning text-dark">{{ Auth::user()->coins }}</span>
                            </li>

                            <li>
                                <form action="{{ route('profile.visibility.toggle') }}" method="POST" class="px-3 py-2">
                                    @csrf
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="visibilitySwitch"
                                               name="visibility"
                                               {{ Auth::user()->visibility ? 'checked' : '' }}
                                               onchange="this.form.submit()">
                                        <label class="form-check-label" for="visibilitySwitch">
                                            {{ Auth::user()->visibility ? __('navbar.visible') : __('navbar.invisible') }}
                                        </label>
                                    </div>
                                </form>
                            </li>
                            <li>
                                <hr class="dropdown-divider mx-2">
                            </li>

                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="dropdown-item py-2 text-danger">@lang('navbar.logout')</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item mx-1">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active fw-bold' : '' }} px-3 rounded-pill"
                           href="{{ route('login') }}">
                            @lang('navbar.login')
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
