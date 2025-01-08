@extends('layouts.app')

@section('title', 'Movies List')

@section('content')
<section class="container my-24 mx-auto">
  <style>
    /* Styling CSS */
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

    .bg-green-500 {
      background-color: #81e6d9;
      color: #ffffff;
    }

    a[href*="movies.create"],
    .grid a {
      background-color: #319795;
      color: #ffffff;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    a[href*="movies.create"]:hover,
    .grid a:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 10px rgba(49, 151, 149, 0.5);
    }

    .grid .relative {
      overflow: hidden;
      border: 1px solid #b2f5ea;
      border-radius: 8px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      background: linear-gradient(to bottom, #e0f7f4, #c3ddf9);
    }

    .grid .relative:hover {
      transform: scale(1.02);
      box-shadow: 0 8px 16px rgba(49, 151, 149, 0.3);
    }

    .grid img {
      border-bottom: 1px solid #b2f5ea;
    }

    .grid .p-4 {
      background: linear-gradient(to top, #e0f7f4, #c3ddf9);
      color: #000;
    }

    .flex-col a {
      background-color: #319795;
      color: #ffffff;
      transition: background-color 0.3s ease;
    }

    .flex-col a:hover {
      background-color: #285e61;
    }

    .action-buttons a {
      margin-right: 0.5rem;
    }
  </style>

  @if(session('success'))
  <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
      {{ session('success') }}
  </div>
  @endif  

  <div class="flex justify-between px-20 mb-4">
    <a href="{{ route('movies.create') }}"
      class="text-white hover:text-white border border-teal-600 bg-teal-700 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-teal-300 rounded-full text-base font-medium px-5 py-2.5 text-center">
      Add Movie
    </a>
  </div>

  <div class="grid grid-cols-2 md:grid-cols-3 gap-6 px-20">
    @forelse ($movies as $movie)
    <div class="relative border rounded-lg shadow-lg hover:shadow-xl transition-shadow">
      <a href="{{ route('movies.show', $movie->id) }}">
        <img class="h-80 w-full object-cover rounded-t-lg"
          src="{{ $movie->poster ? asset('storage/' . $movie->poster) : 'https://via.placeholder.com/150' }}" 
          alt="{{ $movie->title }}">
      </a>

      <div class="absolute top-0 flex justify-between w-full bg-opacity-75 bg-white rounded-t-lg">
        <p class="px-3 py-2 text-lg font-bold">{{ $movie->year }}</p>
        <p class="px-3 py-2 text-lg font-bold">
          {{ $movie->genre ? $movie->genre->name : 'No Genre' }}
        </p>
      </div>

      <div class="p-4">
        <h5 class="text-2xl font-semibold tracking-tight text-teal-900">{{ $movie->title }}</h5>
        <p class="mt-2 text-gray-700">
          Available: {{ $movie->available ? 'Yes' : 'No' }}
        </p>
        <div class="flex justify-between mt-4 action-buttons">
          <a href="{{ route('movies.show', $movie->id) }}"
            class="text-white bg-teal-500 hover:bg-teal-600 font-medium rounded-lg text-sm px-5 py-2.5">
            View
          </a>
          <a href="{{ route('movies.edit', $movie->id) }}"
            class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-sm px-5 py-2.5">
            Edit
          </a>
          <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit"
              class="text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-5 py-2.5">
              Delete
            </button>
          </form>
        </div>
      </div>
    </div>
    @empty
    <div class="flex flex-col items-center justify-center h-96 w-full text-center">
      <div class="p-3 bg-teal-100 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="w-6 h-6 text-teal-500">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
        </svg>
      </div>
      <h1 class="mt-3 text-lg text-teal-900">No movies found</h1>
      <p class="mt-2 text-gray-500">We couldn't find any movies that matched your search.</p>
      <a href="{{ route('movies.create') }}"
        class="mt-4 px-5 py-2 text-sm text-white bg-teal-500 rounded-lg hover:bg-teal-600">
        Add a Movie
      </a>
    </div>
    @endforelse
  </div>
</section>
@endsection
