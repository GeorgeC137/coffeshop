<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table  = 'orders';

    protected $fillable = [
        'address',
        'zip_code',
        'email',
        'price',
        'status',
        'user_id',
        'first_name',
        'last_name',
        'state',
        'city',
        'phone',
    ];

    public $timestamps = true;
}
