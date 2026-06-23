@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Edit Film</h2>

    <form action="{{ route('movies.update', $movie->id) }}" method="POST">
        @csrf
        @method('PUT') 

        <div class="mb-5">
            <label class="block text-gray-700 font-bold mb-2">Judul Film</label>
            <input type="text" name="title" value="{{ old('title', $movie->title) }}" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600">
            @error('title')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Waktu Tayang</label>
            <input type="datetime-local" name="showtime" value="{{ old('showtime', \Carbon\Carbon::parse($movie->showtime)->format('Y-m-d\TH:i')) }}" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600">
            @error('showtime')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between items-center mt-8">
            <a href="{{ route('movies.index') }}" class="text-gray-500 hover:text-gray-700 font-medium transition">&larr; Batal</a>
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-300">
                Update Film
            </button>
        </div>
    </form>
</div>
@endsection