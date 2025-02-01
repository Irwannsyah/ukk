<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class destination extends Model
{
    use HasFactory;
    protected $table = 'destination';

    protected $fillable = [
        'city',
        'title',
        'slug',
        'category_id',
        'price',
        'short_description',
        'description',
        'additional_information',
        'status',
    ];

    static public function getProduct()
    {
        return self::select('product.*')
        ->where('status', '=', 0)
        ->orderBy('product.id', 'asc')
        ->get();
    }

    public function category()
    {
        return $this->belongsTo(category::class, 'category_id');
    }

    static public function getSingle($id){
        return self::find($id);
    }
}
