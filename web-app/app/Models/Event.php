<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Event extends Model
{
    use HasFactory, Notifiable;

    // Assurez-vous que les attributs sont traités comme des dates
    protected $dates = [
        'startDate',
        'endDate',
    ];

    protected $fillable = [
        'name',
        'startDate',
        'endDate',
    ];
}
