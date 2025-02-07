<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;
    protected $table = 'payment';
    protected $fillable = [
        'user_id',
        'order_id',
        'total_amount',
        'status',
        'payment_type',
        'transaction_time'
    ];

    public function orders(){
        return $this->belongsTo(Order::class, 'order_id');
    }
}
