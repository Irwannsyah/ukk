<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ !empty($header_title) ? $header_title : '' }} - Ticket Line</title>
    @yield('style')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>

<body>
    <div class="max-w-screen-xl mx-auto flex gap-8 mt-9 min-h-screen">
        <div class="flex-[25%] border border-[#cdd0d1] rounded-lg bg-white shadow-lg h-full">
            <div class="flex items-center flex-col gap-4 mb-6 p-4">
                <img src="{{ $user->profile ? asset('storage/profile/' . $user->profile) : asset('assets/img/placeholderImg/100x100.png') }}"
                    class="rounded-full w-20 h-20 object-cover" alt="User Profile">
                <div class="text-gray-700">
                    <h1 class="text-xl font-semibold">{{ auth()->user()->name }}</h1>
                </div>
            </div>

            <ul class="flex flex-col space-y-2 px-4">
                <li>
                    <a href="{{ url('profile/user') }}"
                        class="flex items-center gap-2 px-4 py-2 rounded-md transition duration-200 ease-in-out
                        @if (Request::segment(2) == 'user') bg-[#0194f3] text-white @else hover:bg-[#0194f3] hover:text-white text-gray-500 @endif">
                        <i class="fa-solid fa-user"></i>
                        <p>Profile</p>
                    </a>

                </li>
                <li>
                    <a href="{{ url('profile/riwayatorder') }}"
                        class="flex items-center gap-2 px-4 py-2 rounded-md transition duration-200 ease-in-out
                        @if (Request::segment(2) == 'riwayatorder') bg-[#0194f3] text-white @else hover:bg-[#0194f3] hover:text-white text-gray-500 @endif">
                        <i class="fa-solid fa-list"></i>
                        <p>Riwayat</p>
                    </a>
                </li>
                <li>
                    <div class="flex items-center gap-2 px-4 py-2 rounded-md">
                        <i class="fas fa-sign-out-alt"></i>
                        <a href="{{ route('user.logout') }}">Logout</a>
                    </div>
                </li>
            </ul>

        </div>
        @yield('content')
    </div>
    @yield('script')
    <script src="{{ asset('assets/js/app.js') }}"></script>

</html>
