@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection


@section('content')
    <main class="max-w-screen-xl mx-auto p-4 bg-white min-h-screen font-roboto rounded-lg my-20">
        <div class="grid grid-cols-4 gap-2 mb-6">
            <div class="col-span-3">
                <a href="{{ asset('uploads/destination/' . $Destination->image) }}" data-fancybox="gallery">
                    <img src="{{ asset('uploads/destination/' . $Destination->image) }}" alt=""
                        class="w-full h-auto max-h-[470px] object-cover rounded-l-3xl">
                </a>
            </div>
            <div class="grid grid-rows-2 gap-2">
                <!-- Small image 1 -->
                <a href="{{ asset('uploads/destination/' . $Destination->image) }}" data-fancybox="gallery">
                    <img src="{{ asset('uploads/destination/' . $Destination->image) }}" alt="Small image 1"
                        class="w-full h-auto object-cover aspect-[4/3] rounded-se-3xl">
                </a>
                <!-- Small image 2 -->
                <a href="{{ asset('uploads/destination/' . $Destination->image) }}" data-fancybox="gallery" class="relative">
                    <img src="{{ asset('uploads/destination/' . $Destination->image) }}" alt="Small image 2"
                        class="w-full h-auto object-cover aspect-[4/3] rounded-ee-3xl">
                    <span
                        class="px-4 py-1 absolute focus:ring-1 bottom-4 right-4 bg-primary text-white font-medium rounded-md">Gallery</span>
                </a>
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
            </div>
            <div class="md:basis-[25%]  ">
                <div class="w-full p-4 rounded-xl border">
                    <h4 class="text-gray-300 font-semibold mb-12">Mulai dari <br> <span class="text-2xl text-green-500"> Rp
                            {{ number_format($Destination->price, 0, ',', '.') }}</span></h4>
                    <div class="mt-6">
                        <a href="{{ url('checkout/' . $Destination->id) }}"
                            class=" w-full border border-gray-300 shadow-sm px-4 py-2 text-gray-700 flex justify-center hover:bg-opacity-90 items-center gap-4  bg-[#9c2f86] rounded-lg ">
                            <span class="text-lg font-semibold text-white">Pesan</span>
                        </a>
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
