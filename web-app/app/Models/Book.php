<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EventController;

class Book extends Model
{
    protected $fillable = ['tilte', 'page_number', 'cover', 'created_at'];
    protected $appends = ['author_full_name', 'genre_names'];

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_authors', 'bookID', 'authorID');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genres', 'bookID', 'genreID');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'bookID');
    }

    public function getAuthorFullNameAttribute()
    {
        return $this->authors->map(fn($author) => "{$author->first_name} {$author->last_name}")->implode(', ');
    }

    public function getGenreNamesAttribute()
    {
        return $this->genres->pluck('name')->implode(', ');
    }
}
