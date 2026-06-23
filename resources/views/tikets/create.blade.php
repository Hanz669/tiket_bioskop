@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Buat Tiket Baru</h2>

    <form action="{{ route('tikets.store') }}" method="POST">
        @csrf
        
        <div class="mb-5">
            <label class="block text-gray-700 font-bold mb-2">Pilih Film</label>
            <select name="movie_id" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 bg-white">
                <option value="">-- Pilih Film --</option>
                @foreach($movies as $movie)
                    <option value="{{ $movie->id }}">{{ $movie->title }} ({{ \Carbon\Carbon::parse($movie->showtime)->format('d M Y H:i') }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-5">
            <label class="block text-gray-700 font-bold mb-2">Nama Pemesan</label>
            <input type="text" name="customer_name" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600" placeholder="Misal: Farhan">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Nomor Kursi</label>
            <input type="text" name="seat_number" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600" placeholder="Misal: A1">
        </div>

        <div class="flex justify-between items-center mt-8">
            <a href="{{ route('tikets.index') }}" class="text-gray-500 hover:text-gray-700 font-medium transition">&larr; Batal & Kembali</a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-300">
                Generate Tiket
            </button>
        </div>
    </form>
</div>
@endsection