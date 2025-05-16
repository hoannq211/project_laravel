<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'product_name',
        'description',
        'price',
        'stock_quantity',
        'image_url'
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function OrderDetails() {
        return $this->hasMany(OrderDetail::class,'product_id');
    }

    public function images() {
        return $this->morphMany(Image::class,'imageable');
    }
}
