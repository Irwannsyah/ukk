@extends('layouts.headerApp')

@section('content')
    <div
        class="flex-[75%] border border-[#cdd0d1] shadow-lg bg-white rounded-md p-6 h-full flex justify-center items-center">
        <div class="bg-white rounded-lg shadow-md p-6 w-full max-w-lg">
            <h2 class="text-center font-bold text-2xl text-gray-700 mb-6">Edit Profile</h2>

            <form action="{{ route('user.profileupdate') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block font-semibold text-gray-700">Foto Profil:</label>
                    <input type="file" name="profile" class="w-full p-2 border rounded-md">
                    @error('profile_picture')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    @if ($user->profile_picture)
                        <img src="{{ asset('storage/profile/' . $user->profile) }}" alt="Profile Picture"
                            class="mt-2 w-20 h-20 rounded-full">
                    @endif
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                        class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="flex justify-center mt-4">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
