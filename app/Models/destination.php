<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use Money\Parser\DecimalMoneyParser;
use NumberFormatter;

class destination extends Model
{
    use HasFactory;
    protected $table = 'destination';

    protected $fillable = [
        'title',
        'image',
        'city',
        'slug',
        'category_id',
        'price',
        'latitude',
        'longitude',
        'short_description',
        'description',
        'additional_information',
        'status',
    ];

    protected $casts = [
        'images' => 'array',
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

    public function payment(){
        return $this->hasMany(payment::class);
    }

    static public function getSingle($id){
        return self::find($id);
    }

    public function review(){
        return $this->hasMany(Review::class);
    }

    public function gallery(){
        return $this->hasMany(gallery::class);
    }
}
