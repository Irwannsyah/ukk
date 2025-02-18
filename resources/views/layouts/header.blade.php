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
                </ul>
            </li>

            <li>
                @if (Auth::check())
                    <div class="flex items-center gap-4">
                        <a href="{{ route('user.wishlist.index') }}" class="relative group">
                            <div class="relative">
                                <i class="fa-solid fa-heart text-red-600 text-[42px]"></i>
                                <div
                                    class="absolute bottom-3 left-[17px] text-white text-sm font-semibold">
                                    {{ \App\Models\Wishlist::where('user_id', Auth::id())->count() }}
                                </div>
                            </div>
                            <span
                                class="absolute left-1/2 -translate-x-1/2 top-full mt-2 px-2 py-1 bg-gray-800 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                Wishlist
                            </span>
                        </a>

                        <a href="{{ route('user.profileprofile') }}">
                            <img src="{{ $authUser && $authUser->profile ? asset('storage/profile/' . $authUser->profile) : asset('assets/img/placeholderImg/100x100.png') }}"
                    class="w-14 h-14 rounded-full border-2 border-gray-300 object-cover" alt="User Profile">
                        </a>
                    </div>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('user.login') }}">
                            <i class="fa-solid fa-user text-xl"></i>
                        </a>
                    </div>
                @endif
            </li>

        </ul>
    </nav>
</header>
