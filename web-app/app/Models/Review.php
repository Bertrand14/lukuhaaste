<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Review extends Model
{
    protected $fillable = [
        'userID',
        'bookID',
        'note',
        'content',
        'recommend',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'bookID');
    }
}
