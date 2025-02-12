<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;
    protected $table = 'payment';
    protected $guarded = [

    ];

    public function orders(){
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
