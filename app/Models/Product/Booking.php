<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'message',
        'phone',
        'time',
        'last_name',
        'first_name',
        'user_id',
        'date',
    ];

    public $timestamps = true;
}
