@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection


@section('content')
    <section>
            <form action="" method="POST" class="max-w-screen-xl mx-auto bg-white mt-12 p-6 shadow-lg rounded-lg">
                @csrf
                <div class="flex gap-4">
                    <div class="flex-[40%]">
                        <img src="{{ asset('uploads/destination/' . $destination->image) }}" alt="" class="rounded-md object-cover">
                    </div>
                    <div class="flex-[60%] flex-col space-y-2 mb-8">
                        <div>
                            <input type="hidden" id="destination_id" name="destination_id" value="{{ $destination->id }}">
                            <h4 class="text-4xl font-semibold">Tiket Wisata {{ $destination->title }}</h4>
                        </div>
                        <div>
                            <label for="visit_date" class="block text-base font-medium text-gray-700 mb-3">Tanggal Liburan:</label>
                            <input type="date" id="visit_date" name="visit_date"
                                class="w-full px-4 py-2 border-gray-300 text-lg text-gray-900 rounded-md shadow-sm bg-gray-100 cursor-pointer">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pemesan:</label>
                            <h4 class="text-xl">{{ auth()->user()->name }}</h4>
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        </div>


                        <div>
                            <label for="ticket_quantity" class="block text-sm font-medium text-gray-700">Jumlah Tiket:</label>
                            <input type="number" id="ticket_quantity" name="ticket_quantity" value="1" min="1"
                                oninput="updateTotalPrice()"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 hover:bg-gray-50">

                        </div>

                        <div class="flex items-center gap-2 w-full mb-4">
                            <div class="flex-[50%]">
                                <label for="price" class="block text-sm font-medium text-gray-700">Harga Per Tiket:</label>
                                <div id="price"
                                    class="w-full px-4 py-2 border  rounded-lg  text-gray-700 flex items-center gap-1">
                                    <span class="text-lg font-semibold">Rp</span>
                                    <span class="text-lg font-semibold">{{ number_format($destination->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="flex-[50%]">
                                <label for="total_price" class="block text-sm font-medium text-gray-700">Total Harga:</label>
                                <input type="text" name="total_price" id="total_price"
                                    class="w-full px-4 py-2 border border-gray-400 text-lg text-gray-900 rounded-md shadow-sm  cursor-not-allowed"
                                    value="" readonly>
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            Checkout
                        </button>
                    </div>
                </div>
            </form>
    </section>

    </form>

    <script>
        function updateTotalPrice() {
            const ticketQuantity = document.getElementById('ticket_quantity').value;
            const pricePerTicket = {{ $destination->price }};
            const totalPrice = ticketQuantity * pricePerTicket;

            // Format total harga dengan Intl.NumberFormat
            const formattedPrice = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPrice);

            // Tampilkan total harga di input
            document.getElementById('total_price').value = formattedPrice;
        }

        // Panggil fungsi untuk pertama kali saat halaman dimuat
        updateTotalPrice();

        // Mendapatkan elemen input
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
    </script>


    </div>
    </section>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="{{ asset('assets/js/gallery.js') }}"></script>
    <script src="{{ asset('assets/js/maps.js') }}"></script>
@endsection
