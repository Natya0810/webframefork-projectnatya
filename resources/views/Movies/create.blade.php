@extends('layouts.app')

@section('title', 'Tambah Movie')

@section('content')
<section class="container my-24 mx-auto">
  <style>
    /* General Styling */
    body {
      font-family: 'Arial', sans-serif;
      background-color: #e0f7f9; /* Light turquoise background */
      color: #000; /* Black text for body */
    }

    /* Form Container */
    .form-container {
      background: linear-gradient(to bottom, #87ceeb, #ffffff); /* Light blue to white gradient */
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 2rem;
      border: 1px solid #a8dadc; /* Light turquoise border */
      color: #000; /* Black text for the form */
    }

    /* Input Fields */
    .form-container input,
    .form-container textarea,
    .form-container select {
      border-bottom: 2px solid #a8dadc; /* Turquoise border */
      color: #000; /* Black text in input fields */
    }

    .form-container input:focus,
    .form-container textarea:focus,
    .form-container select:focus {
      border-bottom: 2px solid #007f80; /* Darker turquoise border on focus */
      outline: none;
    }

    /* Labels */
    .form-container label {
      color: #000; /* Black text for labels */
    }

    /* Buttons */
    .form-container button {
      background-color: #007f80; /* Turquoise button */
      color: #ffffff;
      transition: background-color 0.3s ease, transform 0.2s;
    }

    .form-container button:hover {
      background-color: #005f60; /* Darker turquoise */
      transform: scale(1.05);
    }

    .form-container a {
      background-color: #a8dadc; /* Light turquoise button */
      color: #007f80; /* Dark turquoise text */
      transition: background-color 0.3s ease, transform 0.2s;
    }

    .form-container a:hover {
      background-color: #007f80; /* Turquoise on hover */
      color: #ffffff;
      transform: scale(1.05);
    }

    /* Error Messages */
    .text-red-500 {
      color: #e63946; /* Red error text */
    }
  </style>

  <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data"
    class="form-container max-w-4xl mx-auto">
    @csrf

    <!-- Title -->
    <div class="relative z-0 w-full mb-5 group">
      <input type="text" id="title" name="title" value="{{ old('title') }}"
        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none peer" placeholder=" "
        required />
      <label for="title" class="peer-focus:font-medium absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0]">Title</label>
      @error('title')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>

    <!-- Synopsis -->
    <div class="relative z-0 w-full mb-5 group">
      <textarea id="synopsis" name="synopsis" rows="4"
        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none peer" placeholder=" "
        required>{{ old('synopsis') }}</textarea>
      <label for="synopsis" class="peer-focus:font-medium absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0]">Synopsis</label>
      @error('synopsis')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>

    <!-- Poster Image -->
    <div class="relative z-0 w-full mb-5 group">
      <input type="file" id="poster" name="poster"
        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none peer" required
        accept="image/*" />
      <label for="poster" class="peer-focus:font-medium absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0]">Poster Image</label>
      @error('poster')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>

    <!-- Year -->
    <div class="relative z-0 w-full mb-5 group">
      <input type="number" id="year" name="year" value="{{ old('year') }}"
        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none peer" placeholder=" "
        required min="1900" max="2100" />
      <label for="year" class="peer-focus:font-medium absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0]">Year</label>
      @error('year')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>

    <!-- Available -->
    <div class="relative z-0 w-full mb-5 group">
      <select id="available" name="available"
        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none peer" required>
        <option value="1" {{ old('available') == 1 ? 'selected' : '' }}>Yes</option>
        <option value="0" {{ old('available') == 0 ? 'selected' : '' }}>No</option>
      </select>
      <label for="available" class="peer-focus:font-medium absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0]">Available</label>
      @error('available')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>

    <!-- Genre -->
    <div class="relative z-0 w-full mb-5 group">
      <select id="genre_id" name="genre_id"
        class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none peer" required>
        <option value="" disabled {{ old('genre_id') ? '' : 'selected' }}>Pilih genre</option>
        @foreach ($genres as $genre)
        <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
          {{ $genre->name }}
        </option>
        @endforeach
      </select>
      <label for="genre_id" class="peer-focus:font-medium absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0]">Genre</label>
      @error('genre_id')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>

    <!-- Submit Button -->
    <button type="submit"
      class="text-white bg-teal-500 hover:bg-teal-600 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Save</button>
    <a href="{{ route('movies.index') }} "
      class="text-teal-700 bg-teal-100 hover:bg-teal-200 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Cancel</a>
  </form>
</section>
@endsection
