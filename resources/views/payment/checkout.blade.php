@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection


@section('content')
<section class="max-w-screen-xl mx-auto bg-white mt-12">
    <div class="max-w-96 mx-auto">

    <form action="" method="POST">
    @csrf

    <!-- Menampilkan nama destinasi -->
    <div>
        <label for="destination_name">Pemesan:</label>
        <input type="text" id="" value="{{ auth()->user()->name }}" readonly>
        <input type="text" name="user_id" value="{{ auth()->user()->id }}" hidden>
    </div>
    <!-- Menampilkan nama destinasi -->
<div>
    <label for="destination_name">Destinasi:</label>
    <!-- ID destinasi disembunyikan -->
    <input type="text" id="destination_id" name="destination_id" value="{{ $data['destination']->id }}" hidden>

    <!-- Nama destinasi ditampilkan -->
    <input type="text" id="destination_name" value="{{ $data['destination']->title }}" readonly>
</div>


    <!-- Input untuk jumlah tiket -->
    <div>
        <label for="ticket_quantity">Jumlah Tiket:</label>
        <input type="number" id="ticket_quantity" name="ticket_quantity" value="1" min="1" oninput="updateTotalPrice()">
    </div>

    <!-- Menampilkan harga per tiket -->
    <div>
        <label for="price">Harga Per Tiket:</label>
        <input type="text" id="price" value="{{ number_format($data['destination']->price, 0, ',', '.')  }}" readonly>
    </div>

    <!-- Menampilkan total harga -->
    <div>
        <label for="total_price">Total Harga:</label>
        <input type="text" name="total_price" id="total_price" value="" readonly>
    </div>
        <div>
        <label for="status">Status Pemesanan:</label>
        <input type="text" id="status" value="Menunggu Pembayaran" readonly>
        <input type="hidden" name="status" value="pending">
    </div>



    <button type="submit">Checkout</button>
</form>

<script>
    function updateTotalPrice() {
    const ticketQuantity = document.getElementById('ticket_quantity').value;
    const pricePerTicket = {{ $data['destination']->price }};
    const totalPrice = ticketQuantity * pricePerTicket;

    // Format total harga dengan Intl.NumberFormat
    const formattedPrice = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPrice);

    // Tampilkan total harga di input
    document.getElementById('total_price').value = formattedPrice;
}

// Panggil fungsi untuk pertama kali saat halaman dimuat
updateTotalPrice();
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
