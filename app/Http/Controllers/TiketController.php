<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TiketController extends Controller
{
    public function index()
    {
        $tikets = Tiket::with('movie')->latest()->get();
        return view('tikets.index', compact('tikets'));
    }

    public function create()
    {
        $movies = Movie::all(); 
        return view('tikets.create', compact('movies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required',
            'customer_name' => 'required',
            'seat_number' => 'required',
        ]);

        $kodeTiket = 'TIX-' . strtoupper(Str::random(8));

        Tiket::create([
            'movie_id' => $request->movie_id,
            'customer_name' => $request->customer_name,
            'seat_number' => $request->seat_number,
            'kode_tiket' => $kodeTiket,
            'status' => 'valid'
        ]);

        return redirect()->route('tikets.index')->with('success', 'Tiket berhasil dibuat!');
    }

    public function show(string$id)
    {
        $tiket = Tiket::with('movie')->findOrFail($id);
        return view('tikets.show', compact('tiket'));
    }

    public function scanner()
    {
        return view('tikets.scanner');
    }

    public function scan(Request $request)
    {
        $tiket = Tiket::where('kode_tiket', $request->kode_tiket)->first();

        if (!$tiket) {
            return response()->json(['success' => false, 'message' => 'Tiket tidak valid!'], 404);
        }

        if ($tiket->status === 'scanned') {
            return response()->json(['success' => false, 'message' => 'Tiket sudah pernah dipakai!'], 400);
        }

        $tiket->update(['status' => 'scanned']);
        return response()->json(['success' => true, 'message' => 'Scan berhasil! Tiket valid.']);
    }
}
