<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banner';
    protected $fillable = [
        'name',
        'image',
    ];


    static public function getSingle($id)
    {
        return self::find($id);
    }

}
