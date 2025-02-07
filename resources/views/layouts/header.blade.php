<header class="w-full p-2 font-roboto  bg-white">
    <nav class="max-w-screen-xl mx-auto">
        <ul class="flex justify-between items-center">
            <li>
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/tiqets-logo-primary-600.svg') }}" alt="" class="w-32">
                </a>
            </li>
            <li>
                @if (Auth::check())
                <a href="{{ route('user.profile') }}">
                    <p>Welcome {{ Auth::user()->name }}</p>
                </a>
                <a href="{{ route('user.logout') }}">
                    Logout
                </a>
                @else
                    <div class="flex items-center gap-4">
                        <a href="">
                            <i class="fa-solid fa-basket-shopping text-xl"></i>
                        </a>
                        <a href="{{ route('user.login') }}">
                                <i class="fa-solid fa-user text-xl"></i>
                        </a>
                    </div>
                @endif
            </li>

        </ul>
    </nav>
</header>
