@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Daftar Film Bioskop</h2>
    <a href="{{ route('movies.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
        + Tambah Film Baru
    </a>
</div>

@if(session('success'))
<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
    <p class="font-bold">Berhasil!</p>
    <p>{{ session('success') }}</p>
</div>
@endif

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead>
            <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                <th class="px-5 py-4 border-b-2 border-gray-200 text-left font-semibold">No</th>
                <th class="px-5 py-4 border-b-2 border-gray-200 text-left font-semibold">Judul Film</th>
                <th class="px-5 py-4 border-b-2 border-gray-200 text-left font-semibold">Waktu Tayang</th>
                <th class="px-5 py-4 border-b-2 border-gray-200 text-center font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movies as $index => $movie)
            <tr class="hover:bg-gray-50 transition duration-150">
                <td class="px-5 py-4 border-b border-gray-200 text-sm font-medium">{{ $index + 1 }}</td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm font-bold text-indigo-600">{{ $movie->title }}</td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm text-gray-700">{{ \Carbon\Carbon::parse($movie->showtime)->format('d M Y - H:i') }}</td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm text-center space-x-3">
                    <a href="{{ route('movies.edit', $movie->id) }}" class="text-amber-500 hover:text-amber-700 font-semibold">Edit</a>
                    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus film ini? Semua tiket untuk film ini akan ikut terhapus!');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection