@extends('layouts.headerApp')

@section('content')
    <div class="max-w-screen-xl mx-auto flex gap-8 mt-9 min-h-screen">
        <div class="flex-[25%] border border-[#cdd0d1] rounded-lg bg-white shadow-lg h-full">
            <div class="flex items-center flex-col gap-4 mb-6 p-4">
                <img src="{{ asset('assets/img/placeholderImg/100x100.png') }}" class="rounded-full w-20 h-20 object-cover"
                    alt="">
                <div class="text-gray-700">
                    <h1 class="text-xl font-semibold">{{ auth()->user()->name }}</h1>
                </div>
            </div>

            <ul class="flex flex-col space-y-2 px-4">
                <li>
                    <a href="{{ url('profile') }}"
                        class="flex items-center gap-2 px-4 py-2 rounded-md transition duration-200 ease-in-out
                        @if (Request::segment(1) == 'profile') bg-[#0194f3] text-white @else hover:bg-[#0194f3] hover:text-white text-gray-500 @endif">
                        <i class="fa-solid fa-user"></i>
                        <p>Profile</p>
                    </a>

                </li>
                <li>
                    <a href=""
                        class="flex items-center gap-2 px-4 py-2 rounded-md transition duration-200 ease-in-out
                        @if (Request::segment(1) == 'Riwayat') bg-[#0194f3] text-white @else hover:bg-[#0194f3] hover:text-white text-gray-500 @endif">
                        <i class="fa-solid fa-list"></i>
                        <p>Riwayat</p>
                    </a>
                </li>
                <li>
                    <a href=""
                        class="flex items-center gap-2 px-4 py-2 rounded-md transition duration-200 ease-in-out
                        @if (Request::segment(1) == 'ticket') bg-[#0194f3] text-white @else hover:bg-[#0194f3] hover:text-white text-gray-500 @endif">
                        <i class="fa-solid fa-ticket"></i>
                        <p>E-Ticket</p>
                    </a>
                </li>
                <li>
                    <form action="{{ route('user.logout') }}" method="POST" class="px-4 py-2">
                        @csrf
                        <button class="text-lg text-red-600 hover:text-red-800 transition duration-200">Logout</button>

                    </form>
                </li>
            </ul>

        </div>
        <div class="flex-[75%] border border-[#cdd0d1] shadow-lg bg-white rounded-md p-2 h-full">
            <div class=" bg-white rounded-md p-2">
                @if ($user->isNotEmpty())
                    <h2 class="text-lg font-bold mb-4">Riwayat Order</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 font-medium">#</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 font-medium">Nama
                                    </th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 font-medium">
                                        Destinasi</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 font-medium">Jumlah
                                        Ticket</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 font-medium">Harga
                                    </th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 font-medium">Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($user as $key => $order)
                                    <tr class="{{ $key % 2 == 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100">
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700 text-center">
                                            {{ $key + 1 }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">{{ $order->user->name }}
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">
                                            {{ $order->destination->title }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">
                                            {{ $order->ticket_quantity }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">{{ $order->total_price }}
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">{{ $order->status }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4"
                                            class="border border-gray-300 px-4 py-2 text-center text-gray-600">
                                            {{ Auth::user()->name }} Anda belum memiliki order.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('assets/img/imgDraw/travelling.png') }}" class="w-48" alt="">
                        <div class="flex flex-col gap-2">
                            <h2 class="font-semibold text-xl">Belum Ada Pesanan</h2>
                            <p class="text-sm">Seluruh Pesanan anda akan tampil di sini, Tapi kini anda masih belum
                                mempunyai pesanan, Mari buat pesanan bersama via homepage!</p>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection

{{-- bg-[#0194f3] --}}
