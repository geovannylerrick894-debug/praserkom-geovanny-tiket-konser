<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class events extends Model
{
    use hasFactory;

    protected $fillable = [
        'concert_name',
        'category',
        'ticket_price',
        'description',
        'image',
    ];
}
