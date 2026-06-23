@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Daftar Tiket Penonton</h2>
    <a href="{{ route('tikets.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
        + Buat Tiket Baru
    </a>
</div>

@if(session('success'))
<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert">
    <p class="font-bold">Berhasil!</p>
    <p>{{ session('success') }}</p>
</div>
@endif

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead>
            <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                <th class="px-5 py-4 border-b-2 border-gray-200 text-left font-semibold">Kode Tiket</th>
                <th class="px-5 py-4 border-b-2 border-gray-200 text-left font-semibold">Nama Pemesan</th>
                <th class="px-5 py-4 border-b-2 border-gray-200 text-left font-semibold">Film</th>
                <th class="px-5 py-4 border-b-2 border-gray-200 text-left font-semibold">Kursi</th>
                <th class="px-5 py-4 border-b-2 border-gray-200 text-left font-semibold">Status</th>
                <th class="px-5 py-4 border-b-2 border-gray-200 text-center font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tikets as $t)
            <tr class="hover:bg-gray-50 transition duration-150">
                <td class="px-5 py-4 border-b border-gray-200 text-sm font-mono font-bold text-indigo-600">{{ $t->kode_tiket }}</td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm font-medium">{{ $t->customer_name }}</td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm">{{ $t->movie->title }}</td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm font-bold text-gray-700">{{ $t->seat_number }}</td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm">
                    @if($t->status == 'valid')
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-1 rounded-full border border-green-300">VALID</span>
                    @elseif($t->status == 'scanned')
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-1 rounded-full border border-blue-300">SCANNED</span>
                    @else
                        <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-1 rounded-full border border-gray-300">CANCELLED</span>
                    @endif
                </td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm text-center space-x-3">
                    <a href="{{ route('tikets.show', $t->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">QR Code</a>
                    @if($t->status === 'valid')
                        <form action="{{ route('tikets.cancel', $t->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin membatalkan tiket ini?');">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="text-gray-500 hover:text-gray-700 font-semibold mx-2">Batal</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection