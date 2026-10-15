<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class orders extends Model
{
    use hasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'total_price',
        'status',
    ];

    public function orderDetails()
    {
        return $this->hasMany(order_details::class, 'order_id');
    }
}
