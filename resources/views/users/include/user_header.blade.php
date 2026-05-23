<!-- Ensure jQuery is loaded first -->
<script src="{{ asset('dist/user/vendor/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Bundle -->
<script src="{{ asset('dist/user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<header class="header-area header-sticky">

    <div class="container">

        <div class="row">

            <div class="col-12">

                <nav class="main-nav">

                    <!-- LOGO -->

                    <a href="{{ route('dashboard') }}" class="logo">

                        <h4 style="color:white; padding-top:15px; font-weight:700;">

                            🎬 ClipNest

                        </h4>

                    </a>

                    <!-- MENU -->

                    <ul class="nav">

                        <li>

                            <a
                                href="{{ route('dashboard') }}"
                                class="{{ request()->routeIs('userpage') ? 'active' : '' }}"
                            >
                                Home
                            </a>

                        </li>

                        <li>

                            <a
                                href="{{ route('categories') }}"
                                class="{{ request()->routeIs('shop') ? 'active' : '' }}"
                            >
                                Categories
                            </a>

                        </li>

                        <li>

                            <a
                                href="{{ route('subscription') }}"
                                class="{{ request()->routeIs('subscriptionpage') ? 'active' : '' }}"
                            >
                                Subscription
                            </a>

                        </li>

                        <!-- LOGIN USER -->

                        <li class="nav-item dropdown">

                            @if(Session::has('name'))

                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="navbarDropdownMenuLink"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >

                                    👋 Welcome,
                                    {{ Session::get('name') }}

                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">
<<!-- LOGIN USER -->

<!-- LOGIN USER -->

<li class="nav-item dropdown">

    @if(Session::has('user_name'))

        <a
            class="nav-link dropdown-toggle"
            href="#"
            id="navbarDropdownMenuLink"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
        >

            👋 Welcome, {{ Session::get('user_name') }}

        </a>

        <ul class="dropdown-menu dropdown-menu-end">

            <li>

                <a
                    class="dropdown-item"
                    href="{{ route('subscription') }}"
                >
                    My Subscription
                </a>

            </li>

            <li>

                <a
                    class="dropdown-item text-danger"
                    href="{{ route('userlogout') }}"
                >
                    Logout
                </a>

            </li>

        </ul>

    @else

        <a
            class="nav-link"
            href="{{ route('user_login') }}"
        >
            Sign In
        </a>

    @endif

</li>
         </ul>

                            @else

                                <a
                                    class="nav-link"
                                    href="{{ route('user_login') }}"
                                >

                                    Sign In

                                </a>

                            @endif

                        </li>

                    </ul>

                    <!-- MOBILE MENU -->

                    <a class='menu-trigger'>

                        <span>Menu</span>

                    </a>

                </nav>

            </div>

        </div>

    </div>

</header>
