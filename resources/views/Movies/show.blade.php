@extends('layouts.app')

@section('title', 'Detail Movie')

@section('content')
<section class="container mx-auto my-24">
  <style>
    /* General Styling */
    body {
      font-family: 'Arial', sans-serif;
      background-color: #e0f7f7; /* Soft toska background */
      color: #000; /* Black text for all body text */
    }

    /* Card Styling */
    .detail-card {
      background: linear-gradient(to bottom, #87ceeb, #ffffff); /* Light blue to white gradient */
      border: 1px solid #b2dfdb; /* Light toska border */
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 2rem;
      max-width: 800px;
      margin: 0 auto;
    }

    .detail-card h1 {
      color: #000; /* Black color for the title */
      font-size: 2rem;
      margin-bottom: 1rem;
    }

    .detail-card p {
      margin-bottom: 1rem;
      color: #000; /* Black color for the text */
    }

    .detail-card strong {
      color: #000; /* Black color for the labels */
    }

    /* Image Styling */
    .detail-card img {
      border-radius: 12px;
      margin-top: 1rem;
      max-height: 320px;
      object-fit: cover;
      width: 100%;
    }

    /* Button Styling */
    .btn {
      display: inline-block;
      padding: 0.75rem 1.5rem;
      font-size: 1rem;
      font-weight: 600;
      text-align: center;
      border-radius: 8px;
      transition: all 0.3s ease;
      text-decoration: none;
    }

    .btn-secondary {
      background-color: #b2dfdb; /* Light toska button */
      color: #004d40; /* Deep toska text */
      border: 1px solid #00796b; /* Toska border */
    }

    .btn-secondary:hover {
      background-color: #00796b; /* Toska on hover */
      color: #ffffff;
    }

    .mt-3 {
      margin-top: 1rem;
    }
  </style>

  <div class="detail-card">
    <h1>{{ $movie->title }}</h1>

    <p><strong>Synopsis:</strong> {{ $movie->synopsis }}</p>
    <p><strong>Year:</strong> {{ $movie->year }}</p>
    <p><strong>Genre:</strong> {{ $movie->genre->name ?? 'No Genre' }}</p>
    <p><strong>Available:</strong> {{ $movie->available ? 'Yes' : 'No' }}</p>

    <img src="{{ $movie->poster ? asset('storage/' . $movie->poster) : 'https://via.placeholder.com/150' }}" 
         alt="{{ $movie->title }}">

    <a href="{{ route('movies.index') }}" class="btn btn-secondary mt-3">Back</a>
  </div>
</section>
@endsection
