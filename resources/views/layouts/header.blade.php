<header class="w-full p-2 font-roboto bg-white">
    <nav class="max-w-screen-xl mx-auto">
        <ul class="flex justify-between items-center">
            <li>
                    <img src="{{ asset('assets/img/tiqets-logo-primary-600.svg') }}" alt="" class="w-32">
            </li>
            <li>
                <ul class="flex items-center gap-6 px-4 py-2">
                    <li>
                        <a href="{{ url('/') }}"
                            class="font-medium text-base text-gray-700 hover:text-blue-500 transition duration-200">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="font-medium text-base text-gray-700 hover:text-blue-500 transition duration-200">
                            Category
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="font-medium text-base text-gray-700 hover:text-blue-500 transition duration-200">
                            Reports
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                @if (Auth::check())
                    <a href="{{ route('user.profile') }}">
                        <img src="{{ asset('assets/img/placeholderImg/100x100.png') }}" alt="Profile Picture"
                            class="w-16 h-16 rounded-full border-2 border-gray-300 object-cover">

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
