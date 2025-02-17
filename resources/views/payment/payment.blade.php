@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection


@section('content')
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
  <script type="text/javascript"
		src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-87Kj-5KnTaMljuPn"></script>
</head>

<body>
<div class="max-w-4xl mx-auto p-6">
    <!-- Judul Halaman -->
    <h1 class="text-center text-2xl font-semibold text-gray-800 mb-8">Payment Information</h1>

    <!-- Formulir Pembayaran -->
    <form action="{{ route('user.paymentpost') }}" method="POST" id="submit_form" class="bg-white p-6 rounded-lg shadow-lg mb-3">
        @csrf
        <!-- Form Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <!-- Destination Name (tampilkan nama destinasi) -->
            <div class="flex flex-col">
                <label for="destination_name" class="text-sm font-medium text-gray-600">Destination</label>
                <input type="text" id="destination_name" name="destination_name" readonly value="{{ $destination->title }}"
                    class="mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
            </div>

            <!-- Visit Date -->
            <div class="flex flex-col">
                <label for="visit_date" class="text-sm font-medium text-gray-600">Visit Date</label>
                <input type="date" id="visit_date" name="visit_date" readonly value="{{ $visit_date }}"
                    class="mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
            </div>

            <!-- Ticket Quantity -->
            <div class="flex flex-col">
                <label for="ticket" class="text-sm font-medium text-gray-600">Ticket Quantity</label>
                <input type="text" id="ticket" name="ticket" readonly value="{{ $ticket }}"
                    class="mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
            </div>

            <!-- User Name (tampilkan nama pengguna) -->
            <div class="flex flex-col">
                <label for="user_name" class="text-sm font-medium text-gray-600">User</label>
                <input type="text" id="user_name" name="user_name" readonly value="{{ Auth::user()->name }}"
                    class="mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
            </div>

            <!-- Email -->
            <div class="flex flex-col">
                <label for="email" class="text-sm font-medium text-gray-600">Email</label>
                <input type="text" id="email" name="email" readonly value="{{ Auth::user()->email }}"
                    class="mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
            </div>
        </div>

        <!-- Hidden Input for Destination ID and User ID -->
        <input type="hidden" name="destination_id" value="{{ $destination->id }}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

        <!-- Hidden Input for JSON Callback -->
        <input type="hidden" name="json" id="json_callback">

        <!-- Submit Button -->
      </form>
      <div class="text-center">
          <button type="submit" id="pay-button"
              class="bg-blue-500 text-white py-3 px-6 rounded-full shadow-md hover:bg-blue-600 transition duration-300">
              Pay Now
          </button>
      </div>
</div>


  <script type="text/javascript">

  var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{ $snapToken }}', {
          onSuccess: function(result){
            send_response_to_form(result);
          },
          onPending: function(result){
            send_response_to_form(result);
          },
          onError: function(result){
            send_response_to_form(result);
          },
          onClose: function(){
            alert('you closed the popup without finishing the payment');
          }
        })
      });

      function send_response_to_form(result){
        document.getElementById('json_callback').value = JSON.stringify(result);
        $('#submit_form').submit();
        // alert(document.getElementById('json_callback').value)
      }
  </script>
</body>

</html>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="{{ asset('assets/js/gallery.js') }}"></script>
    <script src="{{ asset('assets/js/maps.js') }}"></script>
@endsection
