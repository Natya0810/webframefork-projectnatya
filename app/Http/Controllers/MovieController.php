<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    // Menampilkan semua movie
    public function index()
    {
        $movies = Movie::with('genre')->latest()->paginate(10);
        return view('movies.index', compact('movies'));
    }

    // Menampilkan form untuk menambah movie baru
    public function create()
    {
        $genres = Genre::all();
        return view('movies.create', compact('genres'));
    }

    // Menyimpan data movie baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:movies,title',
            'synopsis' => 'required|string|min:10',
            'poster' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:10240',
            'year' => 'required|integer|min:1800|max:' . date('Y'),
            'available' => 'nullable|boolean',
            'genre_id' => 'required|exists:genres,id',
        ]);

        $posterPath = $request->file('poster')->store('posters', 'public');

        $movie = Movie::create([
            'id' => Str::uuid(),
            'title' => $validated['title'],
            'synopsis' => $validated['synopsis'],
            'poster' => $posterPath,
            'year' => $validated['year'],
            'available' => $validated['available'] ?? true,
            'genre_id' => $validated['genre_id'],
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie created successfully.');
    }

    // Menampilkan detail movie berdasarkan ID
    public function show($id)
    {
        $movie = Movie::with('genre')->findOrFail($id);
        return view('movies.show', compact('movie'));
    }

    // Menampilkan form untuk mengedit movie
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $genres = Genre::all();
        return view('movies.edit', compact('movie', 'genres'));
    }

    // Memperbarui data movie
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:movies,title,' . $movie->id,
            'synopsis' => 'required|string|min:10',
            'poster' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:10240',
            'year' => 'required|integer|min:1800|max:' . date('Y'),
            'available' => 'nullable|boolean',
            'genre_id' => 'required|exists:genres,id',
        ]);

        if ($request->hasFile('poster')) {
            // Hapus poster lama jika ada
            if ($movie->poster && Storage::disk('public')->exists($movie->poster)) {
                Storage::disk('public')->delete($movie->poster);
            }

            // Upload poster baru
            $posterPath = $request->file('poster')->store('posters', 'public');
            $movie->poster = $posterPath;
        }

        $movie->update([
            'title' => $validated['title'],
            'synopsis' => $validated['synopsis'],
            'year' => $validated['year'],
            'available' => $validated['available'] ?? true,
            'genre_id' => $validated['genre_id'],
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');
    }

    // Menghapus movie
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        // Hapus poster jika ada
        if ($movie->poster && Storage::disk('public')->exists($movie->poster)) {
            Storage::disk('public')->delete($movie->poster);
        }

        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }
}
