@extends('layouts.headerApp')

@section('content')
    <div class="flex-[75%] border border-[#cdd0d1] shadow-lg bg-white rounded-md p-2 h-full">
        <div class=" bg-white rounded-md p-2">
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
                            <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 font-medium">Tanggal Liburan
                            </th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 font-medium">Status
                            </th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 font-medium">Invoice
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($paid as $key => $pay)
                            <tr class="{{ $key % 2 == 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2 text-gray-700 text-sm text-center">
                                    {{ $key + 1 }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-gray-700 text-sm">{{ $pay->user->name }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-gray-700 text-sm">
                                    {{ $pay->destination->title }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-gray-700 text-sm">
                                    {{ $pay->ticket }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-gray-700 text-sm">
                                    Rp {{ number_format((int) $pay->gross_amount, 0, ',', '.') }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-gray-700 text-sm">{{ $pay->visit_date }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-gray-700 text-sm">{{ $pay->status }}
                                </td>
                                @if ($pay->status == 'settlement')
                                    <td class="border border-gray-300 px-4 py-2 text-gray-700 text-sm">
                                        <a href="{{ url('/pdf/view/' . $pay->transaction_id) }}">Inovoice</a>
                                    </td>
                                @elseif ($pay->status == 'pending')
                                    <td class="border border-gray-300 px-4 py-2 text-gray-700 text-sm">Sedang menunggu
                                        konfirmasi
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="border border-gray-300 px-4 py-2 text-center text-gray-600">
                                    {{ Auth::user()->name }} Anda belum memiliki order.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- @else
                <div class="flex items-center gap-2">
                    <img src="{{ asset('assets/img/imgDraw/travelling.png') }}" class="w-48" alt="">
                    <div class="flex flex-col gap-2">
                        <h2 class="font-semibold text-xl">Belum Ada Pesanan</h2>
                        <p class="text-sm">Seluruh Pesanan anda akan tampil di sini, Tapi kini anda masih belum
                            mempunyai pesanan, Mari buat pesanan bersama via homepage!</p>
                    </div>
                </div>
            @endif --}}
        </div>

    </div>
@endsection
