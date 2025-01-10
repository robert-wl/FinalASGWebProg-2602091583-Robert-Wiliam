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
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        @lang('navbar.home')
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('friends') ? 'active' : '' }}"
                       href="{{ route('friends') }}">
                        @lang('navbar.friends')
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('messages') ? 'active' : '' }}"
                       href="{{ route('messages') }}">
                        @lang('navbar.messages')
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('topup') ? 'active' : '' }}" href="{{ route('topup') }}">
                        @lang('navbar.topup')
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('navbar.language')
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('language.switch', 'en') }}">English</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('language.switch', 'id') }}">Indonesia</a>
                        </li>
                    </ul>
                </li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="px-3 py-2">
                                <strong>@lang('navbar.coins'):</strong> {{ Auth::user()->coins }}
                            </li>


                            <li>
                                <form action="{{ route('profile.visibility.toggle') }}" method="POST" class="px-3 py-2">
                                    @csrf
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="visibilitySwitch"
                                               name="visibility"
                                               {{ Auth::user()->visible ? 'checked' : '' }} onchange="this.form.submit()">
                                        <label class="form-check-label" for="visibilitySwitch">
                                            {{ Auth::user()->visible ? __('navbar.visible') : __('navbar.invisible') }}
                                        </label>
                                    </div>
                                </form>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">@lang('navbar.logout')</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}"
                           href="{{ route('login') }}">
                            @lang('navbar.login')
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
