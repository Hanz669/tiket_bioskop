<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::latest()->get();
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'showtime' => 'required|date',
        ]);

        Movie::create([
            'title' => $request->title,
            'showtime' => $request->showtime,
        ]);

        return redirect()->route('movies.index')->with('success', 'Film baru berhasil ditambahkan!');
    }
    public function edit(int $id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'showtime' => 'required|date',
        ]);

        $movie = Movie::findOrFail($id);
        $movie->update([
            'title' => $request->title,
            'showtime' => $request->showtime,
        ]);

        return redirect()->route('movies.index')->with('success', 'Data film berhasil diperbarui!');
    }

    public function destroy(int $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Film berhasil dihapus!');
    }
}
