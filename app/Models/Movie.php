<?php

// app/Models/Movie.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    // Menentukan tabel terkait
    protected $table = 'movies';

    // Mengatur field yang dapat diisi (Mass Assignment)
    protected $fillable = [
        'id',
        'title',
        'synopsis',
        'poster',
        'year',
        'available',
        'genre_id'
    ];

    // Menentukan bahwa kolom id adalah string (UUID)
    protected $keyType = 'string';
    public $incrementing = false;  // Menonaktifkan auto-increment

    // Mengatur type casting
    protected $casts = [
        'genre_id' => 'string',  // pastikan genre_id adalah string jika menggunakan UUID
        'available' => 'boolean',
        'year' => 'integer',
    ];

    // Menentukan atribut default
    protected $attributes = [
        'available' => true,
    ];

    // Relasi dengan Genre
    public function genre()
    {
        return $this->belongsTo(Genre::class);  // Relasi belongsTo dengan Genre
    }

    // Accessor untuk judul
    public function getTitleAttribute($value)
    {
        return ucfirst($value);  // Mengubah title menjadi kapital pertama
    }

    // Mutator untuk judul
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtolower($value);  // Mengubah title menjadi huruf kecil
    }

    // Scope untuk filter genre
    public function scopeFilterByGenre($query, $genreId)
    {
        return $query->where('genre_id', $genreId);
    }

    // Scope untuk status tersedia
    public function scopeAvailable($query)
    {
        return $query->where('available', true);
    }

    // Validasi request
    public static function validate($request)
    {
        return $request->validate([
            'title'     => 'required|string|max:255',
            'synopsis'  => 'nullable|string',
            'poster'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'year'      => 'required|integer|min:1900|max:' . date('Y'),
            'available' => 'required|boolean',
            'genre_id'  => 'required|exists:genres,id',
        ]);
    }
}
