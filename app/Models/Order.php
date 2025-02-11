<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Parser\DecimalMoneyParser;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'destination_id',
        'total_price',
        'ticket_quantity',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }

    static public function getSingle($id){
        return self::find($id);
    }

    public function formatTotal()
    {
        // Menggunakan ISOCurrencies untuk mendapatkan mata uang
        $currencies = new ISOCurrencies();

        // Menggunakan DecimalMoneyParser untuk mengubah format harga
        $moneyParser = new DecimalMoneyParser($currencies);

        // Parse nilai harga yang ada di database dengan mata uang IDR
        $money = $moneyParser->parse($this->total_price, new Currency('IDR'));

        // Mengubah nilai menjadi format yang mudah dibaca dengan pemisah ribuan
        $formattedAmount = number_format($money->getAmount() / 100, 0, ',', '.');

        // Mengembalikan harga dengan simbol mata uang 'Rp'
        return 'Rp ' . $formattedAmount;
    }
}
