@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center mt-10">
    <div class="bg-white max-w-sm w-full rounded-2xl shadow-xl overflow-hidden border border-gray-200">
        <div class="bg-indigo-600 p-4 text-center text-white">
            <h3 class="text-lg font-bold uppercase tracking-widest">E-Ticket Bioskop</h3>
            <p class="text-sm opacity-80 mt-1">Tunjukkan QR Code ini ke petugas</p>
        </div>
        
        <div class="p-6 border-b border-dashed border-gray-300">
            <div class="flex justify-between mb-4">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Film</p>
                    <p class="font-bold text-gray-800 text-lg">{{ $tiket->movie->title }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Kursi</p>
                    <p class="font-bold text-indigo-600 text-xl">{{ $tiket->seat_number }}</p>
                </div>
            </div>
            <div class="flex justify-between">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Nama Pemesan</p>
                    <p class="font-semibold text-gray-800">{{ $tiket->customer_name }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Status</p>
                    <p class="font-bold {{ $tiket->status == 'valid' ? 'text-green-600' : 'text-red-600' }} uppercase">
                        {{ $tiket->status }}
                    </p>
                </div>
            </div>
        </div>

        <div class="p-6 bg-gray-50 flex flex-col items-center">
            <div class="bg-white p-3 rounded-xl shadow-sm border border-gray-200 mb-3">
                {!! QrCode::size(180)->generate($tiket->kode_tiket) !!}
            </div>
            <p class="font-mono text-gray-600 tracking-[0.2em] font-bold">{{ $tiket->kode_tiket }}</p>
        </div>
    </div>
</div>

<div class="text-center mt-8">
    <a href="{{ route('tikets.index') }}" class="text-gray-500 hover:text-indigo-600 font-medium underline">&larr; Kembali ke Daftar Tiket</a>
</div>
@endsection