<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = ['code','amount','quntity','amount_type','product_id'];


    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
