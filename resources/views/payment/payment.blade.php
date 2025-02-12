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
    <!-- @TODO: You can add the desired ID as a reference for the embedId parameter. -->
    <div id="snap-container" class="flex items-center justify-center min-h-screen">
        <form action="{{ route('user.paymentpost') }}" method="POST" id="submit_form" class="max-w-screen-md mx-auto bg-white rounded-md">
            @csrf
            <div class="grid grid-cols-2">
                <h4>{{ $order->order_id }}</h4>
                <h4>{{ $order->user->name }}</h4>
                <h4>{{ $order->destination->title }}</h4>
                <h4>{{ $order->total_price }}</h4>
             </div>

            <button id="pay-button">Pay!</button>
            <input type="hidden" name="json" id="json_callback">
</form>

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
