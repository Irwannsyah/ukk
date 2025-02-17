@extends('layouts.app')

@section('content')
<h1 class="text-center text-xl font-bold mt-12 text-gray-800">My Wishlist</h1>
<div class="max-w-4xl mx-auto px-4">
    @foreach ($wishlist as $wish)
        <div class="wishlist-item border p-4 rounded-lg shadow-md mb-6 hover:shadow-lg transition-shadow duration-300">
            <div class="flex gap-6">
                <!-- Gambar Destinasi -->
                <img src="{{ asset('uploads/destination/' . ($wish->destination->firstImage ?? 'default.jpg')) }}" alt=""
                    class="w-24 h-24 object-cover rounded-lg shadow-md">

                <!-- Detail Wishlist -->
                <div class="wishlist-details flex-1">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $wish->destination->title }}</h2>
                    <p class="text-gray-500 text-sm">{{ $wish->destination->city }}</p>
                    <p class="text-sm text-gray-700 mt-2 line-clamp-2">{{ $wish->destination->short_description }}</p>

                    <!-- Button untuk menuju ke halaman detail destinasi -->
                    <a href="{{ route('user.detail', ['id' => $wish->destination->id]) }}"
                        class="inline-block mt-4 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
