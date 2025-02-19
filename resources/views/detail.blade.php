@extends('layouts.app')

@section('style')
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection


@section('content')
    <main class="max-w-screen-xl mx-auto p-4 bg-white min-h-screen font-roboto rounded-lg my-20">
        <div class="grid grid-cols-4 gap-2 mb-6">
            <div class="col-span-3">
                <!-- Gambar besar pertama -->
                @if ($Destination->gallery_image->count() > 0)
                    <a href="{{ asset($Destination->gallery_image[0]->image) }}" data-fancybox="gallery">
                        <img src="{{ asset($Destination->gallery_image[0]->image) }}" alt=""
                            class="w-full h-auto max-h-[470px] object-cover rounded-l-3xl">
                    </a>
                @else
                    <p>No images available.</p>
                @endif
            </div>

            <div class="grid grid-rows-2 gap-2">
                @foreach ($Destination->gallery_image as $key => $image)
                    @if ($key == 0)
                        <!-- Small image 1 -->
                        <a href="{{ asset($image->image) }}" data-fancybox="gallery">
                            <img src="{{ asset($image->image) }}" alt="Small image 1"
                                class="w-full h-auto object-cover aspect-[4/3] rounded-se-3xl">
                        </a>
                    @elseif ($key == 1)
                        <!-- Small image 2 -->
                        <a href="{{ asset($image->image) }}" data-fancybox="gallery" class="relative">
                            <img src="{{ asset($image->image) }}" alt="Small image 2"
                                class="w-full h-auto object-cover aspect-[4/3] rounded-ee-3xl">
                            <span
                                class="px-4 py-1 absolute focus:ring-1 bottom-4 right-4 bg-primary text-white font-medium rounded-md">Gallery</span>
                        </a>
                    @endif
                @endforeach
            </div>

        </div>

        <div class="flex justify-between gap-4">
            <div class="md:basis-[75%]  ">
                <h1 class="text-[32px] font-semibold  mb-9">Tiket Wisata {{ $Destination->title }}</h1>
                <ul class="flex flex-col gap-8">
                    <li class=" p-4">
                        <h4 class="text-2xl font-semibold mb-4 ">Deskripsi</h4>
                        <div class="text-[16px] text-gray-700 font-roboto">
                            <p>
                                {{ $Destination->description }}
                            </p>
                        </div>
                    </li>
                    <li class=" p-4">
                        <h4 class="uppercase text-2xl font-semibold mb-4">Jam Buka</h4>
                        <div class="text-xl text-gray-700">
                            <p>09:00 - 18:00</p>
                        </div>
                    </li>
                    <li class="p-4">
                        <div class="flex items-center gap-4 mb-4">
                            <i class="fa-regular fa-map text-xl"></i>
                            <a href="https://www.google.com/maps?q={{ $Destination->latitude }},{{ $Destination->longitude }}"
                                target="_blank"
                                class="text-[#037b95] hover:underline text-2xl font-semibold">{{ $Destination->city }}</a>
                        </div>
                        <input type="hidden" id="latitude" value="{{ $Destination->latitude }}">
                        <input type="hidden" id="longitude" value="{{ $Destination->longitude }}">
                        <div class="w-full h-56" id="map"></div>
                    </li>
                </ul>
                @if (Auth::check() && $hasOrder && !$HasReview)
                    <div class="mt-6 bg-white p-6 rounded-lg shadow-md mb-8">
                        <h2 class="text-lg font-semibold mb-4">Tulis Ulasan Anda</h2>
                        <div class="flex items-center gap-2">
                            <div class="font-semibold mb-3">-- {{ Auth::user()->name }}</div>
                        </div>
                        <form action="{{ url('/sendReview') }}" method="POST">
                            @csrf
                            <input type="hidden" name="destination_id" value="{{ $Destination->id }}">

                            {{-- Rating (Bintang Klikable) --}}
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Rating</label>
                                <div class="flex gap-2 text-yellow-400 text-2xl cursor-pointer" id="star-rating">
                                    <i class="fa-regular fa-star" data-value="1"></i>
                                    <i class="fa-regular fa-star" data-value="2"></i>
                                    <i class="fa-regular fa-star" data-value="3"></i>
                                    <i class="fa-regular fa-star" data-value="4"></i>
                                    <i class="fa-regular fa-star" data-value="5"></i>
                                </div>
                                <input type="hidden" name="rating" id="rating" value="0">
                            </div>

                            {{-- Review Textarea --}}
                            <div class="mb-4">
                                <label for="review" class="block text-sm font-medium text-gray-700">Ulasan</label>
                                <textarea name="review" id="review" rows="4" required
                                    class="w-full border border-gray-300 p-3 rounded-md focus:ring-primary focus:border-primary min-h-[100px]"
                                    placeholder="Bagikan pengalaman Anda..."></textarea>
                            </div>

                            {{-- Tombol Submit --}}
                            <button type="submit"
                                class="w-full bg-primary text-black bg-purple-600 py-2 rounded-md font-semibold hover:bg-opacity-90 transition">
                                Kirim Ulasan
                            </button>
                        </form>
                    </div>
                @elseif(Auth::check() && $HasReview)
                    <p class="text-gray-500 italic mb-6 text-center font-semibold">Terimakasih Anda sudah memberikan review
                        untuk destinasi ini.</p>
                @else
                    <p class="text-gray-500 italic text-center font-semibold">Anda harus membeli tiket dan menyelesaikan
                        pembayaran sebelum memberikan
                        ulasan.</p>
                @endif

                <div class="bg-white shadow-md rounded-lg p-6 max-w-5xl mx-auto">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Ulasan Pelanggan</h2>

                    <!-- Rata-rata Rating -->
                    <div class="flex items-center justify-center mb-6">
                        <span class="text-yellow-500 text-3xl font-bold">{{ number_format($review_avg, 1) }}</span>
                        <div class="flex ml-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <span
                                    class="{{ $i <= round($review_avg) ? 'text-yellow-500' : 'text-gray-300' }} text-xl">★</span>
                            @endfor
                        </div>
                        <span class="ml-2 text-gray-600">({{ $review_count }} ulasan)</span>
                    </div>

                    <!-- Grid Ulasan -->
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($review as $view)
                            <div class="p-4 border border-gray-300 rounded-md shadow-sm">
                                <!-- Nama pengguna + Avatar -->
                                <div class="flex items-center gap-3 mb-3">
                                    <img src="{{ $view->user->profile ? asset('storage/profile/' . $view->user->profile) : asset('assets/img/placeholderImg/100x100.png') }}"
                                        class="w-10 h-10 rounded-full object-cover" alt="User Profile">

                                    <div>
                                        <strong
                                            class="text-lg font-semibold text-gray-800">{{ $view->user->name }}</strong>
                                        <p class="text-sm text-gray-500">{{ $view->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>

                                <!-- Bintang rating -->
                                <div class="flex gap-1 mb-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span
                                            class="{{ $i <= $view->rating ? 'text-yellow-500' : 'text-gray-300' }} text-xl">★</span>
                                    @endfor
                                </div>

                                <!-- Komentar -->
                                <p class="text-gray-700 text-base leading-relaxed">{{ $view->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="md:basis-[25%]">
                <div class="w-full p-4 rounded-xl border">
                    <h4 class="text-gray-300 font-semibold mb-12">Mulai dari <br> <span class="text-2xl text-green-500">
                            Rp
                            {{ number_format($Destination->price, 0, ',', '.') }}</span></h4>
                    <form action="" method="POST" class="p-6 bg-white shadow-md rounded-lg">
                        @csrf
                        <div class="flex flex-col gap-4">
                            <!-- Input Tanggal Kunjungan -->
                            <label for="visit_date" class="text-sm font-medium text-gray-700">Tanggal Kunjungan</label>
                            <input type="date" id="visit_date" name="visit_date"
                                class="border border-gray-300 p-2 rounded-md w-full focus:ring-2 focus:ring-primary focus:border-primary">

                            <!-- Input Jumlah Tiket -->
                            <div>
                                <label for="ticket_quantity" class="text-sm font-medium text-gray-700">Jumlah
                                    Tiket</label>
                                <div class="flex items-center gap-2 mt-1">
                                    <input type="number" id="ticket_quantity" name="ticket_quantity" value="1"
                                        min="1" oninput="updateTotalPrice()"
                                        class="border border-gray-300 p-2 rounded-md w-24 text-center focus:ring-2 focus:ring-primary focus:border-primary">
                                </div>
                            </div>

                            <!-- Input Harga Total (Readonly) -->
                            <div>
                                <label for="total_price" class="text-sm font-medium text-gray-700">Total Harga</label>
                                <input type="text" name="total_price" id="total_price"
                                    class="border border-gray-300 p-2 rounded-md w-full text-lg font-semibold text-gray-900 bg-gray-100 cursor-not-allowed"
                                    value="" readonly>
                            </div>

                            <!-- Hidden Inputs -->
                            <input type="hidden" name="price" value="{{ $Destination->price }}">
                            <input type="hidden" name="destination_id" value="{{ $Destination->id }}">

                            <!-- Tombol Pesan -->
                            <button type="submit"
                                class="w-full bg-primary text-black font-semibold py-3 rounded-md hover:bg-opacity-90 transition duration-300 bg-purple-600 text-white">
                                Pesan Tiket
                            </button>
                        </div>
                    </form>
                    <div class="mt-6">
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('sweet_alert') && session('sweet_alert.showLogin'))
            Swal.fire({
                icon: '{{ session('sweet_alert.icon') }}',
                title: '{{ session('sweet_alert.title') }}',
                text: '{{ session('sweet_alert.text') }}',
                showCancelButton: true,
                confirmButtonText: 'Login',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('user.login') }}";
                }
            });
        @endif

        const visitDateInput = document.getElementById('visit_date');

        // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD
        const today = new Date().toISOString().split('T')[0];

        // Mengatur nilai default input dengan tanggal hari ini
        visitDateInput.value = today;

        // Mengatur batasan agar pengguna tidak bisa memilih tanggal kemarin
        const yesterday = new Date();
        yesterday.setDate(yesterday.getDate() - 1); // Mengurangi satu hari dari hari ini
        const yesterdayDate = yesterday.toISOString().split('T')[0]; // Format YYYY-MM-DD

        visitDateInput.setAttribute('min', today);

        document.addEventListener("DOMContentLoaded", function() {
            updateTotalPrice(); // Memastikan total_price langsung diisi saat halaman dimuat
        });

        function updateTotalPrice() {
            const ticketQuantityInput = document.getElementById('ticket_quantity');
            const totalPriceInput = document.getElementById('total_price');
            const pricePerTicket = {{ $Destination->price }};

            // Ambil nilai jumlah tiket, jika kosong gunakan 1 sebagai default
            let ticketQuantity = parseInt(ticketQuantityInput.value) || 1;
            let totalPrice = ticketQuantity * pricePerTicket;

            // Format total harga dengan Intl.NumberFormat
            totalPriceInput.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPrice);
        }


        document.addEventListener("DOMContentLoaded", function() {
            const stars = document.querySelectorAll("#star-rating i");
            const ratingInput = document.getElementById("rating");

            stars.forEach(star => {
                star.addEventListener("click", function() {
                    const value = this.getAttribute("data-value");
                    ratingInput.value = value; // Set nilai rating yang dipilih

                    // Reset semua bintang
                    stars.forEach(s => s.classList.remove("fa-solid", "text-yellow-500"));
                    stars.forEach(s => s.classList.add("fa-regular"));

                    // Aktifkan bintang sesuai rating yang dipilih
                    for (let i = 0; i < value; i++) {
                        stars[i].classList.remove("fa-regular");
                        stars[i].classList.add("fa-solid", "text-yellow-500");
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
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
    <script src="{{ asset('assets/js/gallery.js') }}"></script>
    <script src="{{ asset('assets/js/maps.js') }}"></script>
@endsection
