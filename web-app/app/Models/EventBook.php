<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventBook extends Model{

    use HasFactory;

    protected $table = 'event_books';
    protected $fillable = ['userID', 'bookID', 'typeID', 'pageNb', 'eventID'];

    public function user(){
        return $this->belongsTo(User::class, 'userID');
    }

    public function book(){
        return $this->belongsTo(Book::class, 'bookID');
    }

    public function event(){
        return $this->belongsTo(Event::class, 'eventID');
    }
}
