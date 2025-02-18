@extends('layouts.headerApp')

@section('content')
<div class="flex-[75%] border border-[#cdd0d1] shadow-lg bg-white rounded-md p-6 h-full flex justify-center items-center">
    <div class="bg-white rounded-lg shadow-md p-6 w-full max-w-lg">
        <h2 class="text-center font-bold text-2xl text-gray-700 mb-6">Data User</h2>

        <div class="space-y-4 text-gray-700">
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold">Nama:</span>
                <span class="text-gray-600">{{ $user->name }}</span>
            </div>

            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-semibold">Email:</span>
                <span class="text-gray-600">{{ $user->email }}</span>
            </div>

            <div class="flex justify-between items-center">
                <span class="font-semibold">Phone:</span>
                <span class="text-gray-600">{{ $user->phone }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="font-semibold">Total Pesanan:</span>
                <span class="text-gray-600">{{ $payment }}</span>
            </div>
            <div class="flex justify-center">
                <a href="{{ route('user.profileform') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md">Edit Profile</a>
            </div>
        </div>
    </div>
</div>
@endsection
