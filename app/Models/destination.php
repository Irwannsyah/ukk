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

    public function formatPrice()
    {
        // Menggunakan ISOCurrencies untuk mendapatkan mata uang
        $currencies = new ISOCurrencies();

        // Menggunakan DecimalMoneyParser untuk mengubah format harga
        $moneyParser = new DecimalMoneyParser($currencies);

        // Parse nilai harga yang ada di database dengan mata uang IDR
        $money = $moneyParser->parse($this->price, new Currency('IDR'));

        // Mengembalikan harga dalam satuan yang lebih mudah dibaca
        return $money->getAmount() / 100;  // Mengubah kembali ke format biasa, misalnya 100000 -> 1000
    }
}
