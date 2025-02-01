<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = [
        'name',
        'slug',
    ];

    static public function getCategory(){
        return Category::select('category.*')
                        ->orderBy('category.id', 'asc')
                        ->get();
    }

    static public function getSingle($id){
        return Category::find($id);
    }

    public function destination(){
        return $this->hasMany(destination::class, 'category_id');
    }
}
