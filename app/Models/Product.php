<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'image_url',
    ];

    public function category(){
        return $this->belongsTo(Categorie::class);
    }
    public function orderItems(){
        return $this->hasMany(Order_item::class);
    }
    public function reviews(){
        return $this->hasMany(review::class);
    }
}
