@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
@endsection

@section('content')
    <main class="max-w-screen-xl mx-auto p-4 bg-white min-h-screen font-roboto  rounded-lg my-12">
        <div id="owl-carousel" class="owl-carousel owl-theme flex mb-9">
            <div class="item">
                <img src="{{ asset('assets/img/placeholderImg/1504x500.png') }}" alt="Image 1">
            </div>
            <div class="item">
                <img src="{{ asset('assets/img/placeholderImg/1504x500.png') }}" alt="Image 2">
            </div>
            <div class="item">
                <img src="{{ asset('assets/img/placeholderImg/1504x500.png') }}" alt="Image 3">
            </div>
            <div class="item">
                <img src="{{ asset('assets/img/placeholderImg/1504x500.png') }}" alt="Image 4">
            </div>
            <div class="item">
                <img src="{{ asset('assets/img/placeholderImg/1504x500.png') }}" alt="Image 5">
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4 mb-9">
            <div class="flex bg-[#f2f4f7] rounded-md p-4 gap-4">
                <img src="{{ asset('assets/css/salary.png') }}" class="w-16 h-16" alt="">
                <div class="banner">
                    <h4>Stay Flexible</h4>
                    <h5>Flexible cancellation options on all venue</h5>
                </div>
            </div>
            <div class="flex bg-[#f2f4f7] rounded-md p-4 gap-4">
                <img src="{{ asset('assets/css/salary.png') }}" class="w-16 h-16" alt="">
                <div class="banner">
                    <h4>Stay Flexible</h4>
                    <h5>Easy booking and skip-the-line entry on your phone</h5>
                </div>
            </div>
            <div class="flex bg-[#f2f4f7] rounded-md p-4 gap-4">
                <img src="{{ asset('assets/css/salary.png') }}" class="w-16 h-16" alt="">
                <div class="banner">
                    <h4>Stay Flexible</h4>
                    <h5>The best experiences at museums and attractions worldwide</h5>
                </div>
            </div>
        </div>

        <h2 class="text-center mb-9 text-4xl font-medium font-poppins">Category</h2>
        <div class="grid grid-cols-3 gap-8 mb-40">
            @foreach ($get_category as $value)
                <a href="{{ route('user.category', ['id' => $value->id]) }}">
                    <img src="{{ asset('uploads/category/' . $value->image) }}" alt=""
                        class="w-full h-56 object-cover rounded-md opacity-65 hover:opacity-100 duration-200 mb-4">
                    <div class="text-center">
                        <h4 class="font-medium text-3xl">{{ $value->name }}</h4>
                    </div>
                </a>
            @endforeach
        </div>

        <section class="mb-9">
            <h4 class="text-3xl font-medium mb-9 text-center">Top Destinasi</h4>
            <div class="grid grid-cols-4 gap-9">
                @foreach ($get_record as $value)
                    <div class="rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-200 block">
                        <div class="destination-item relative">
                            <a href="{{ route('user.detail', ['id' => $value->id]) }}">
                                @if ($value->firstImage)
                                    <img src="{{ asset('uploads/destination/' . $value->firstImage) }}" alt="Banner Image"
                                        class="w-full h-auto object-cover rounded-lg">
                                @else
                                    <p class="text-center text-gray-500 py-4">No image available.</p>
                                @endif
                            </a>
                        </div>

                        <div class="p-4 flex flex-col gap-4">
                            <div class="space-y-2">
                                <h4 class="font-medium text-gray-500 text-xs tracking-widest uppercase">{{ $value->city }}
                                </h4>
                                <h1 class="font-bold text-[#484753] text-lg font-monserrat">{{ $value->title }}</h1>
                                <p class="line-clamp-2 text-sm text-gray-600">{{ $value->short_description }}</p>
                            </div>
                            <div class="flex items-end justify-between">
                                <div class="flex items-center gap-1 text-sm">
                                    <img src="{{ asset('assets/img/star.png') }}" alt="" class="w-4 h-4">
                                    <span class="font-medium">5</span>
                                    <span class="text-gray-500">(1)</span>
                                </div>
                                <div class="text-right">
                                    <h5 class="text-sm text-gray-500">Mulai</h5>
                                    <span class="text-xl font-semibold text-[#e02e4c]">Rp
                                        {{ number_format($value->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            {{-- Tombol Wishlist --}}
                            <form action="{{ route('user.wishlist.add') }}" method="POST" class="mt-2">
                                @csrf
                                <input type="hidden" name="destination_id" value="{{ $value->id }}">
                                <button type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">
                                    ❤️
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <div class="p-4 bg-white border rounded-xl">
            <div id="owl-demo-5" class="owl-carousel gap-2 items-center relative">
                @foreach ($brands as $value)
                    <div class="w-30 mx-auto">
                        <img src="{{ asset('uploads/brand/' . $value->image) }}" alt="Brand Image"
                            class="w-full h-40 object-cover">
                    </div>
                @endforeach
            </div>
        </div>
        @if (!empty(session('success')))
            <div id="popup"
                class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg text-center max-w-sm w-full">
                    <!-- Gambar -->
                    <img src="{{ asset('assets/img/imgDraw/not_allowed.png') }}" class="w-36 mx-auto" alt="Gambar Guest">

                    <!-- Teks -->
                    <h2 class="text-xl font-semibold mb-2">{{ session('success') }}</h2>
                    <div class="flex items-center justify-center gap-4 mt-4">
                        <!-- Tombol Login -->
                        <a href="{{ route('user.login') }}"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
                            Cek Invoice & E-Ticket
                        </a>
                        <!-- Tombol Tidak -->
                        <button onclick="closePopup()" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-700">
                            Kembali
                        </button>
                    </div>
                </div>
            </div>
        @elseif (!empty(session('failed')))
            <div id="popup"
                class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg text-center max-w-sm w-full">
                    <!-- Gambar -->
                    <img src="{{ asset('assets/img/imgDraw/not_allowed.png') }}" class="w-36 mx-auto"
                        alt="Gambar Guest">

                    <!-- Teks -->
                    <h2 class="text-xl font-semibold mb-2">{{ session('failed') }}</h2>
                </div>
            </div>
        @endif
    </main>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        // Fungsi untuk menutup popup dan mengembalikan scroll
        function closePopup() {
            document.getElementById('popup').style.display = 'none';
            document.body.style.overflow = 'auto'; // Mengembalikan scroll setelah popup ditutup
        }

        // Menonaktifkan scroll ketika popup muncul
        window.onload = function() {
            if (document.getElementById('popup')) {
                document.body.style.overflow = 'hidden'; // Menonaktifkan scroll
            }
        }
    </script>
    <script src="{{ asset('assets/js/carousel.js') }}"></script>
@endsection
