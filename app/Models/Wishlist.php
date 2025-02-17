<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $table = 'wishlist';
    protected $fillable = ['user_id', 'destination_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function destination(){
        return $this->belongsTo(destination::class, 'destination_id');
    }
}
