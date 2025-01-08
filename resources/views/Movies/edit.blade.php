@extends('layouts.app')

@section('title', 'Edit Movie')

@section('content')
<section class="container my-24 mx-auto">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #e0f7f4;
      color: #333;
    }

    section.container {
      padding: 2rem;
      border-radius: 12px;
      background-color: #ffffff;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    label {
      font-weight: bold;
      color: #319795;
    }

    input,
    select,
    textarea {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #b2f5ea;
      border-radius: 8px;
      font-size: 1rem;
    }

    button {
      background-color: #319795;
      color: #ffffff;
      font-size: 1rem;
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #285e61;
    }

    .back-link {
      text-decoration: none;
      color: #319795;
      font-size: 1rem;
      display: inline-block;
      margin-bottom: 1.5rem;
      transition: color 0.3s ease;
    }

    .back-link:hover {
      color: #285e61;
    }
  </style>

  <a href="{{ route('movies.index') }}" class="back-link">← Back to Movies List</a>

  <h1 class="text-3xl font-bold text-teal-900 mb-6">Edit Movie</h1>

  <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Title -->
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" name="title" id="title" value="{{ old('title', $movie->title) }}" required>
      @error('title')
      <p class="text-red-500 text-sm">{{ $message }}</p>
      @enderror
    </div>

    <!-- Year -->
    <div class="form-group">
      <label for="year">Year</label>
      <input type="number" name="year" id="year" value="{{ old('year', $movie->year) }}" required>
      @error('year')
      <p class="text-red-500 text-sm">{{ $message }}</p>
      @enderror
    </div>

    <!-- Genre -->
    <div class="form-group">
      <label for="genre_id">Genre</label>
      <select name="genre_id" id="genre_id" required>
        <option value="">Select Genre</option>
        @foreach ($genres as $genre)
        <option value="{{ $genre->id }}" {{ old('genre_id', $movie->genre_id) == $genre->id ? 'selected' : '' }}>
          {{ $genre->name }}
        </option>
        @endforeach
      </select>
      @error('genre_id')
      <p class="text-red-500 text-sm">{{ $message }}</p>
      @enderror
    </div>

    <!-- Available -->
    <div class="form-group">
      <label for="available">Available</label>
      <select name="available" id="available" required>
        <option value="1" {{ old('available', $movie->available) == 1 ? 'selected' : '' }}>Yes</option>
        <option value="0" {{ old('available', $movie->available) == 0 ? 'selected' : '' }}>No</option>
      </select>
      @error('available')
      <p class="text-red-500 text-sm">{{ $message }}</p>
      @enderror
    </div>

    <!-- Synopsis -->
    <div class="form-group">
      <label for="synopsis">Synopsis</label>
      <textarea name="synopsis" id="synopsis" rows="4" required>{{ old('synopsis', $movie->synopsis) }}</textarea>
      @error('synopsis')
      <p class="text-red-500 text-sm">{{ $message }}</p>
      @enderror
    </div>

    <!-- Poster -->
    <div class="form-group">
      <label for="poster">Poster</label>
      <input type="file" name="poster" id="poster">
      @if ($movie->poster)
      <p class="mt-2">Current Poster:</p>
      <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" class="h-40 mt-2">
      @endif
      @error('poster')
      <p class="text-red-500 text-sm">{{ $message }}</p>
      @enderror
    </div>

    <!-- Submit Button -->
    <button type="submit">Update Movie</button>
  </form>
</section>
@endsection
