<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// $ php artisan tinker
// >>> $kategori = App\Models\Category::first();
// >>> $kategori->products;
// => Illuminate\Database\Eloquent\Collection {#...}
// >>> $produk = App\Models\Product::first();
// >>> $produk->category->name;
// => "Sembako"


class Category extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
