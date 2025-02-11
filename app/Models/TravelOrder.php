<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelOrder extends Model
{
    /** @use HasFactory<\Database\Factories\TravelOrderFactory> */
    use HasFactory;

    protected $fillable = [
        'travel_order_id',
        'name',
        'destination',
        'user_id',
        'start_date',
        'end_date',
        'order_status_id',
    ];

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }
}
